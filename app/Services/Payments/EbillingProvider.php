<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * E-Billing (CGI) transaction inquiry. Fails closed until the inquiry endpoint
 * (services.ebilling.inquiry_url) and response shape are confirmed with CGI.
 */
class EbillingProvider implements PaymentProviderInterface
{
    public function verify(string $reference): PaymentVerificationResult
    {
        $url = config('services.ebilling.inquiry_url');
        if (empty($url)) {
            Log::critical('E-Billing inquiry skipped: services.ebilling.inquiry_url not configured (fail closed).');
            return PaymentVerificationResult::failed('not_configured', $reference);
        }

        try {
            $response = Http::withBasicAuth(
                (string) config('services.ebilling.username'),
                (string) config('services.ebilling.shared_key')
            )->get(rtrim($url, '/') . '/' . $reference);
        } catch (\Throwable $e) {
            Log::error('E-Billing inquiry failed: ' . $e->getMessage());
            return PaymentVerificationResult::failed('error', $reference);
        }

        if (! $response->successful()) {
            return PaymentVerificationResult::failed('http_' . $response->status(), $reference);
        }

        $body = $response->json();
        $state = strtolower((string) data_get($body, 'state', data_get($body, 'status', '')));
        $amount = (float) data_get($body, 'amount', 0);

        if (in_array($state, ['paid', 'processed', 'success'], true)) {
            return PaymentVerificationResult::paid($amount, $reference);
        }

        return PaymentVerificationResult::failed($state ?: 'unpaid', $reference);
    }
}
