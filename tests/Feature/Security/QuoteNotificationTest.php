<?php

namespace Tests\Feature\Security;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use App\Mail\StatusMessage;
use App\Models\Country;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Characterization tests for the quote notification fan-out, pinned BEFORE it
 * is extracted into App\Services\QuoteNotifier. They freeze the exact set of
 * mailables queued on creation and status change, plus the admin-audience rule
 * (security_role_id <= 2), so the extraction is provably behaviour-preserving.
 */
class QuoteNotificationTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private function pdf(string $name): UploadedFile
    {
        return UploadedFile::fake()->create($name, 100, 'application/pdf');
    }

    private function country(): Country
    {
        $c = new Country();
        $c->label = 'Gabon';
        $c->code = 'GA';
        $c->flag = 'ga.png';
        $c->status = '1';
        $c->user_id = 1;
        $c->save();

        return $c;
    }

    private function validQuotePayload(int $serviceId, int $countryId): array
    {
        return [
            'lastname' => 'Dupont',
            'firstname' => 'Jean',
            'birthday' => '1990-01-01',
            'gender' => 'M',
            'email' => 'client@example.test',
            'phone' => '074010203',
            'category' => 'standard',
            'service_id' => $serviceId,
            'country_id' => $countryId,
            'join_piece_passport' => $this->pdf('passport.pdf'),
            'join_piece_rapport' => $this->pdf('rapport.pdf'),
            'join_piece_examen' => $this->pdf('examen.pdf'),
        ];
    }

    public function test_authenticated_submission_persists_quote_and_queues_notifications(): void
    {
        Storage::fake('local');
        Mail::fake();

        $owner = $this->makeUser();
        $service = $this->makeService();
        $country = $this->country();

        $this->actingAs($owner)
            ->post('/quote', $this->validQuotePayload($service->id, $country->id))
            ->assertRedirect();

        $this->assertSame(1, Quote::count());
        $quote = Quote::first();
        $this->assertSame(STATUT_RECEIVE, (int) $quote->status);
        $this->assertSame($owner->id, (int) $quote->user_id);

        // Client notified once; the fixed admin address gets one admin mail
        // (no security_role_id<=2 users seeded here).
        Mail::assertQueued(QuoteMessage::class, 1);
        Mail::assertQueued(QuoteAdminMessage::class, 1);
    }

    public function test_admin_recipients_are_users_with_role_id_lte_2(): void
    {
        Storage::fake('local');
        Mail::fake();

        $this->makeUser(['email' => 'a1@example.test', 'security_role_id' => 1]);
        $this->makeUser(['email' => 'a2@example.test', 'security_role_id' => 2]);
        $this->makeUser(['email' => 'a3@example.test', 'security_role_id' => 3]); // must be excluded

        $owner = $this->makeUser();
        $service = $this->makeService();
        $country = $this->country();

        $this->actingAs($owner)
            ->post('/quote', $this->validQuotePayload($service->id, $country->id));

        // 1 fixed admin address + exactly the two role<=2 admins = 3.
        Mail::assertQueued(QuoteAdminMessage::class, 3);
    }

    public function test_updatestate_saves_status_and_queues_status_mail_to_owner(): void
    {
        Storage::fake('local');
        Mail::fake();

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        // updateState is an admin action (POST /admin/quotes-state/{id}); it
        // notifies the quote's owner.
        $this->actingAs($this->makeAdmin())
            ->post('/admin/quotes-state/' . $quote->id, [
                'status' => 5, // STATUT_PAID
                'response' => 'Traitement terminé',
                'devis' => $this->pdf('devis.pdf'),
            ])->assertRedirect();

        $quote->refresh();
        $this->assertSame(5, (int) $quote->status);
        $this->assertSame('Traitement terminé', $quote->response);
        Mail::assertQueued(StatusMessage::class, 1);
    }
}
