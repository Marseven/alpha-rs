<?php

namespace Tests\Feature\Security;

use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * The /notify/* webhooks must never mark a payment PAID based on an
 * unauthenticated, unverified payload. They require a valid HMAC signature
 * and the reported amount must match the amount we expect server-side.
 */
class PaymentWebhookTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private string $secret = 'test-webhook-secret';

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.payment.webhook_secret' => $this->secret]);
    }

    private function pendingPayment(string $reference, int $amount = 100): Payment
    {
        return $this->makePayment([
            'reference' => $reference,
            'amount' => (string) $amount,
            'status' => 1, // STATUT_PENDING
        ]);
    }

    private function singpayBody(string $reference, int $amount): string
    {
        return json_encode([
            'transaction' => [
                'reference' => $reference,
                'result' => 'Success',
                'id' => 'TX-123',
                'amount' => $amount,
            ],
        ]);
    }

    private function postSinged(string $body, ?string $signature): \Illuminate\Testing\TestResponse
    {
        $server = ['CONTENT_TYPE' => 'application/json'];
        if ($signature !== null) {
            $server['HTTP_X_WEBHOOK_SIGNATURE'] = $signature;
        }

        return $this->call('POST', '/notify/singpay', [], [], [], $server, $body);
    }

    public function test_unsigned_webhook_does_not_mark_payment_paid(): void
    {
        $payment = $this->pendingPayment('REF-UNSIGNED');
        $body = $this->singpayBody('REF-UNSIGNED', 100);

        $this->postSinged($body, null);

        $payment->refresh();
        $this->assertNotEquals(5, (int) $payment->status, 'Payment must stay unpaid.');
    }

    public function test_webhook_with_invalid_signature_is_rejected(): void
    {
        $payment = $this->pendingPayment('REF-BADSIG');
        $body = $this->singpayBody('REF-BADSIG', 100);

        $this->postSinged($body, 'deadbeef-not-a-valid-signature');

        $payment->refresh();
        $this->assertNotEquals(5, (int) $payment->status);
    }

    public function test_valid_webhook_marks_payment_paid(): void
    {
        $payment = $this->pendingPayment('REF-OK', 100);
        $body = $this->singpayBody('REF-OK', 100);
        $sig = hash_hmac('sha256', $body, $this->secret);

        $this->postSinged($body, $sig);

        $payment->refresh();
        $this->assertEquals(5, (int) $payment->status, 'Valid signed webhook should mark PAID.');
        $this->assertEquals('TX-123', $payment->transaction_id);
    }

    public function test_valid_signature_but_wrong_amount_is_rejected(): void
    {
        $payment = $this->pendingPayment('REF-AMOUNT', 100);
        // Attacker replays a valid signature scheme but understates the amount.
        $body = $this->singpayBody('REF-AMOUNT', 1);
        $sig = hash_hmac('sha256', $body, $this->secret);

        $this->postSinged($body, $sig);

        $payment->refresh();
        $this->assertNotEquals(5, (int) $payment->status, 'Amount mismatch must not be accepted.');
    }

    public function test_unknown_reference_is_rejected(): void
    {
        $body = $this->singpayBody('REF-DOES-NOT-EXIST', 100);
        $sig = hash_hmac('sha256', $body, $this->secret);

        $response = $this->postSinged($body, $sig);

        $this->assertContains($response->getStatusCode(), [402, 404]);
    }

    public function test_guest_cannot_use_payment_callback(): void
    {
        $this->get('/callback-singpay/folder/1/REF')->assertRedirect('/login');
    }

    public function test_user_cannot_use_callback_for_another_users_folder(): void
    {
        $owner = $this->makeUser();
        $attacker = $this->makeUser();
        $folder = $this->makeFolder($owner);

        $this->actingAs($attacker)
            ->get('/callback-singpay/folder/' . $folder->id . '/REF')
            ->assertForbidden();
    }
}
