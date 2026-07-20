<?php

namespace Tests\Feature\Security;

use App\Http\Controllers\FileController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Sensitive documents must live on the private disk (never public/upload) and
 * only be reachable through an authenticated, policy-checked download route.
 */
class PrivateDocumentTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_uploaded_document_is_stored_privately_not_in_public(): void
    {
        Storage::fake('local');
        $file = UploadedFile::fake()->create('passport.pdf', 50, 'application/pdf');

        $result = FileController::quote_file($file);

        $this->assertTrue($result['state']);
        $this->assertStringStartsWith('private/', $result['url']);
        $this->assertStringNotContainsString('upload', $result['url']);
        Storage::disk('local')->assertExists($result['url']);
    }

    public function test_owner_can_download_their_own_quote_document(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('private/quotes/doc.pdf', '%PDF-1.4 fake');

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);
        $quote->join_piece_passport = 'private/quotes/doc.pdf';
        $quote->save();

        $this->actingAs($owner)
            ->get('/files/quotes/' . $quote->id . '/passport')
            ->assertOk();
    }

    public function test_client_cannot_download_another_clients_document(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('private/quotes/doc.pdf', '%PDF-1.4 fake');

        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $quote = $this->makeQuote($owner);
        $quote->join_piece_passport = 'private/quotes/doc.pdf';
        $quote->save();

        $this->actingAs($attacker)
            ->get('/files/quotes/' . $quote->id . '/passport')
            ->assertForbidden();
    }

    public function test_guest_cannot_download_documents(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->get('/files/quotes/' . $quote->id . '/passport')->assertRedirect('/login');
    }

    public function test_unknown_field_is_rejected(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)
            ->get('/files/quotes/' . $quote->id . '/secret')
            ->assertNotFound();
    }

    public function test_missing_file_returns_404(): void
    {
        Storage::fake('local');
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);
        $quote->join_piece_passport = 'private/quotes/does-not-exist.pdf';
        $quote->save();

        $this->actingAs($owner)
            ->get('/files/quotes/' . $quote->id . '/passport')
            ->assertNotFound();
    }

    /**
     * Legacy documents still physically under public/upload/quote are now denied
     * direct web access (public/upload/quote/.htaccess). That must NOT break the
     * legitimate path: the download route reads them from the filesystem, so an
     * owner keeps access while the public URL is closed.
     */
    public function test_legacy_public_path_document_is_still_served_to_its_owner(): void
    {
        $relative = 'upload/quote/legacy-regression-test.pdf';
        $absolute = public_path($relative);
        @mkdir(dirname($absolute), 0755, true);
        file_put_contents($absolute, '%PDF-1.4 legacy');

        try {
            $owner = $this->makeUser();
            $quote = $this->makeQuote($owner);
            $quote->join_piece_passport = $relative;
            $quote->save();

            // (the foreign-client refusal is covered by
            // test_client_cannot_download_another_clients_document)
            $this->actingAs($owner)
                ->get('/files/quotes/' . $quote->id . '/passport')
                ->assertOk();
        } finally {
            @unlink($absolute);
        }
    }
}
