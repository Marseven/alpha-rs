<?php

namespace Tests\Feature\Security;

use App\Models\Folder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

/**
 * IDOR / broken-access regression tests for client-owned resources.
 *
 * A client must only ever reach their OWN quotes and folders. These tests
 * fail against the legacy code (no ownership checks) and pass once Policies
 * are enforced.
 */
class ResourceAccessTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_guest_is_redirected_from_client_routes(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->get('/quote/payment/' . $quote->id)->assertRedirect('/login');
        $this->get('/list-quotes')->assertRedirect('/login');
    }

    public function test_client_cannot_open_payment_page_of_another_clients_quote(): void
    {
        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($attacker)
            ->get('/quote/payment/' . $quote->id)
            ->assertForbidden();
    }

    public function test_client_can_open_payment_page_of_their_own_quote(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)
            ->get('/quote/payment/' . $quote->id)
            ->assertOk();
    }

    public function test_client_cannot_pay_another_clients_quote(): void
    {
        Http::fake(); // guard: no real PSP call should ever be reached
        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($attacker)
            ->get('/quote/pay/' . $quote->id)
            ->assertForbidden();

        Http::assertNothingSent();
    }

    public function test_client_cannot_pay_another_clients_folder(): void
    {
        Http::fake();
        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $folder = $this->makeFolder($owner);

        $this->actingAs($attacker)
            ->post('/folder/pay/' . $folder->id)
            ->assertForbidden();

        Http::assertNothingSent();
    }

    public function test_client_cannot_convert_another_clients_quote_into_a_folder(): void
    {
        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($attacker)
            ->post('/folder/quote/' . $quote->id)
            ->assertForbidden();

        // No folder should have been created for the attacker.
        $this->assertDatabaseCount('folders', 0);
    }

    public function test_owner_can_convert_their_own_quote_into_a_folder(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $this->actingAs($owner)
            ->post('/folder/quote/' . $quote->id)
            ->assertRedirect();

        $this->assertSame(1, Folder::where('user_id', $owner->id)->count());
    }
}
