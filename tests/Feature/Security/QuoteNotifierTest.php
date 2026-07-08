<?php

namespace Tests\Feature\Security;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use App\Mail\QuoteReadyMessage;
use App\Mail\StatusMessage;
use App\Services\QuoteNotifier;
use App\Services\SensitiveFileStorage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
        Mail::assertNotQueued(QuoteReadyMessage::class);
    }

    public function test_processed_quote_with_devis_sends_the_devis_to_the_client(): void
    {
        Mail::fake();

        $owner = $this->makeUser(['email' => 'client@example.test']);
        $quote = $this->makeQuote($owner);
        $quote->status = 6; // STATUT_DO ("Traité")
        $quote->devis = 'private/quotes/devis-abc.pdf';
        $quote->save();

        (new QuoteNotifier())->notifyStatusChanged($quote);

        Mail::assertQueued(QuoteReadyMessage::class, fn ($mail) => $mail->hasTo('client@example.test'));
        Mail::assertNotQueued(StatusMessage::class);
    }

    public function test_processed_quote_without_devis_falls_back_to_status_notice(): void
    {
        Mail::fake();

        $quote = $this->makeQuote($this->makeUser());
        $quote->status = 6; // Traité, but no devis document attached yet
        $quote->save();

        (new QuoteNotifier())->notifyStatusChanged($quote);

        Mail::assertQueued(StatusMessage::class, 1);
        Mail::assertNotQueued(QuoteReadyMessage::class);
    }

    public function test_quote_ready_mail_attaches_the_devis_document(): void
    {
        Storage::fake('local');

        $owner = $this->makeUser();
        $quote = $this->makeQuote($owner);
        $quote->reference = 'ABC123';
        $quote->devis = 'private/quotes/devis-abc.pdf';
        $quote->save();
        Storage::disk('local')->put($quote->devis, '%PDF-1.4 fake devis');

        $mail = new QuoteReadyMessage($quote);

        $mail->assertHasAttachment(
            SensitiveFileStorage::absolutePath($quote->devis),
            ['as' => 'Devis-ABC123.pdf'],
        );
    }
}
