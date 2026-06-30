<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Authenticates incoming payment webhooks.
 *
 * The body is signed with an HMAC-SHA256 of the raw request payload using a
 * shared secret (services.payment.webhook_secret). Requests without a valid
 * signature are rejected — the webhook can no longer be forged to mark an
 * arbitrary payment as paid.
 *
 * Note: the exact header name / signing scheme must be aligned with what the
 * PSP actually sends. Where a provider cannot sign its callbacks, this gate
 * must be paired with a server-to-server inquiry before trusting the event
 * (documented as a residual item).
 */
class PaymentWebhookVerifier
{
    public const SIGNATURE_HEADER = 'X-Webhook-Signature';

    public function verify(Request $request): bool
    {
        $secret = config('services.payment.webhook_secret');

        if (empty($secret)) {
            // Fail closed: without a configured secret we cannot trust anything.
            Log::critical('Payment webhook rejected: PAYMENT_WEBHOOK_SECRET is not set.');
            return false;
        }

        $provided = (string) $request->header(self::SIGNATURE_HEADER, '');
        if ($provided === '') {
            Log::warning('Payment webhook rejected: missing signature header.');
            return false;
        }

        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        $ok = hash_equals($expected, $provided);
        if (! $ok) {
            Log::warning('Payment webhook rejected: signature mismatch.');
        }

        return $ok;
    }
}
