<?php

namespace Tests\Feature\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

/**
 * The devis e-mail now carries a signed "magic access" link so the client can
 * open their devis without a password (a guest request creates an account with
 * no password). The link must be tamper-proof (signed) and only grant the quote
 * owner's own session.
 */
class QuoteAccessLinkTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_a_valid_signed_link_logs_the_owner_in_and_opens_the_devis(): void
    {
        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);

        $url = URL::temporarySignedRoute('quote.access', now()->addDays(30), ['quote' => $quote->id]);

        $response = $this->get($url);

        $response->assertRedirect('/quote/payment/' . $quote->id);
        $this->assertAuthenticatedAs($owner);

        // ...and the (now authenticated) owner reaches the devis page.
        $this->get('/quote/payment/' . $quote->id)->assertOk();
    }

    public function test_an_unsigned_link_is_rejected(): void
    {
        $quote = $this->makeQuote($this->makeUser());

        $this->get('/acces-devis/' . $quote->id)->assertForbidden();
        $this->assertGuest();
    }

    public function test_a_tampered_signature_is_rejected(): void
    {
        $quote = $this->makeQuote($this->makeUser());

        $url = URL::temporarySignedRoute('quote.access', now()->addDays(30), ['quote' => $quote->id]);

        $this->get($url . 'tampered')->assertForbidden();
        $this->assertGuest();
    }

    public function test_an_expired_link_is_rejected(): void
    {
        $quote = $this->makeQuote($this->makeUser());

        $url = URL::temporarySignedRoute('quote.access', now()->subMinute(), ['quote' => $quote->id]);

        $this->get($url)->assertForbidden();
        $this->assertGuest();
    }
}
