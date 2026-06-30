<?php

namespace App\Services\Payments;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Singpay transaction inquiry.
 *
 * NOTE: the exact inquiry endpoint / response shape must be confirmed with
 * Singpay (see docs/HARDENING_REPORT.md "Actions humaines"). Until the URL is
 * configured (services.singpay.inquiry_url) this fails closed.
 */
class SingpayProvider implements PaymentProviderInterface
{
    public function verify(string $reference): PaymentVerificationResult
    {
        $url = config('services.singpay.inquiry_url');
        if (empty($url)) {
            Log::critical('Singpay inquiry skipped: services.singpay.inquiry_url not configured (fail closed).');
            return PaymentVerificationResult::failed('not_configured', $reference);
        }

        try {
            $response = Http::withHeaders([
                'x-wallet' => config('services.singpay.wallet_id'),
                'x-client-id' => config('services.singpay.client_id'),
                'x-client-secret' => config('services.singpay.client_secret'),
            ])->get(rtrim($url, '/') . '/' . $reference);
        } catch (\Throwable $e) {
            Log::error('Singpay inquiry failed: ' . $e->getMessage());
            return PaymentVerificationResult::failed('error', $reference);
        }

        if (! $response->successful()) {
            return PaymentVerificationResult::failed('http_' . $response->status(), $reference);
        }

        $body = $response->json();
        $status = strtolower((string) data_get($body, 'transaction.result', data_get($body, 'status', '')));
        $amount = (float) data_get($body, 'transaction.amount', data_get($body, 'amount', 0));

        if (in_array($status, ['success', 'paid', 'completed'], true)) {
            return PaymentVerificationResult::paid($amount, $reference);
        }

        return PaymentVerificationResult::failed($status ?: 'unpaid', $reference);
    }
}
