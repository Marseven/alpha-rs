<?php

namespace Tests\Feature\Security;

use App\Services\Payments\PaymentVerificationResult;
use App\Services\Payments\SingpayProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * When inquiry is required, a signed webhook must additionally be confirmed by
 * a server-to-server inquiry (status + amount), never the payload alone.
 */
class PaymentInquiryTest extends TestCase
{
    use RefreshDatabase, CreatesDomainData;

    private string $secret = 'test-webhook-secret';

    protected function setUp(): void
    {
        parent::setUp();
        config([
            'services.payment.webhook_secret' => $this->secret,
            'services.payment.require_provider_inquiry' => true,
        ]);
    }

    private function fakeSingpay(PaymentVerificationResult $result): void
    {
        $fake = new class($result) extends SingpayProvider {
            public function __construct(private PaymentVerificationResult $r) {}
            public function verify(string $reference): PaymentVerificationResult
            {
                return $this->r;
            }
        };
        $this->app->instance(SingpayProvider::class, $fake);
    }

    private function postSigned(string $reference, int $amount): \Illuminate\Testing\TestResponse
    {
        $body = json_encode([
            'transaction' => [
                'reference' => $reference,
                'result' => 'Success',
                'id' => 'TX-1',
                'amount' => $amount,
            ],
        ]);
        $sig = hash_hmac('sha256', $body, $this->secret);

        return $this->call('POST', '/notify/singpay', [], [], [], [
            'CONTENT_TYPE' => 'application/json',
            'HTTP_X_WEBHOOK_SIGNATURE' => $sig,
        ], $body);
    }

    public function test_signed_webhook_but_inquiry_unconfirmed_is_rejected(): void
    {
        $this->fakeSingpay(PaymentVerificationResult::failed('unpaid'));
        $payment = $this->makePayment(['reference' => 'REF-A', 'amount' => '100', 'status' => 1]);

        $this->postSigned('REF-A', 100);

        $this->assertNotEquals(5, (int) $payment->refresh()->status);
    }

    public function test_signed_webhook_inquiry_amount_mismatch_is_rejected(): void
    {
        $this->fakeSingpay(PaymentVerificationResult::paid(1, 'REF-B'));
        $payment = $this->makePayment(['reference' => 'REF-B', 'amount' => '100', 'status' => 1]);

        $this->postSigned('REF-B', 100);

        $this->assertNotEquals(5, (int) $payment->refresh()->status);
    }

    public function test_signed_webhook_with_confirmed_inquiry_is_validated(): void
    {
        $this->fakeSingpay(PaymentVerificationResult::paid(100, 'REF-C'));
        $payment = $this->makePayment(['reference' => 'REF-C', 'amount' => '100', 'status' => 1]);

        $this->postSigned('REF-C', 100);

        $this->assertEquals(5, (int) $payment->refresh()->status);
    }
}
