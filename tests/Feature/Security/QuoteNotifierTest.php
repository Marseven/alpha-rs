<?php

namespace Tests\Feature\Security;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use App\Mail\StatusMessage;
use App\Services\QuoteNotifier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/**
 * Unit-level guard for the extracted QuoteNotifier: it must reproduce the
 * controller's former fan-out byte-for-byte (client + fixed admin + one mail
 * per security_role_id<=2 admin) and the single status mail.
 */
class QuoteNotifierTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    public function test_notify_created_queues_client_and_admin_mails(): void
    {
        Mail::fake();

        $this->makeUser(['email' => 'a1@example.test', 'security_role_id' => 1]);
        $this->makeUser(['email' => 'a2@example.test', 'security_role_id' => 2]);
        $this->makeUser(['email' => 'a3@example.test', 'security_role_id' => 3]); // excluded

        $quote = $this->makeQuote($this->makeUser());

        (new QuoteNotifier())->notifyCreated($quote);

        Mail::assertQueued(QuoteMessage::class, 1);
        Mail::assertQueued(QuoteAdminMessage::class, 3); // 1 fixed + 2 admins
    }

    public function test_notify_status_changed_queues_a_single_owner_mail(): void
    {
        Mail::fake();

        $quote = $this->makeQuote($this->makeUser());

        (new QuoteNotifier())->notifyStatusChanged($quote);

        Mail::assertQueued(StatusMessage::class, 1);
    }
}
