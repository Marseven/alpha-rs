<?php

namespace App\Services\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PaymentAmountResolver;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Outbound Singpay charge initiation.
 *
 * Persists a PENDING payment with the server-resolved amount (so the webhook
 * amount-check stays authoritative) and reports the gateway redirect link.
 *
 * Every attempt is traced with a correlation id so a failed payment can be
 * diagnosed in production from the logs alone. Credentials are never logged and
 * the payer's phone number is masked.
 */
class SingpayGateway
{
    /** Seconds to wait for the gateway (explicit, not the framework default). */
    private const TIMEOUT = 20;
    private const CONNECT_TIMEOUT = 10;

    /**
     * Initiate a charge for a Folder or Quote and persist the pending payment.
     *
     * @param  string  $type    'folder' | 'quote'
     * @param  mixed   $entity   Folder or Quote model
     * @return array{ok: bool, link: string|null, reason: string|null}
     */
    public function initiate(string $type, $entity): array
    {
        $trace = (string) Str::uuid();

        $entity->loadMissing(['service']);
        $amount = PaymentAmountResolver::for($type, $entity);

        if ($missing = $this->missingConfiguration()) {
            // Fail fast and loudly: previously the null credentials were sent to
            // the PSP, which answered with an opaque error the app read as success.
            Log::critical('Singpay charge aborted: missing configuration', [
                'trace' => $trace,
                'missing' => $missing,
                'type' => $type,
                'entity_id' => $entity->id,
            ]);

            return ['ok' => false, 'link' => null, 'reason' => 'configuration'];
        }

        // Idempotence: a double click (the trigger is a plain link) used to create
        // a second Payment with a second reference for the same charge.
        $payment = $this->existingPendingPayment($type, $entity, $amount);
        $reference = $payment?->reference ?? Controller::str_random_pay(8);

        Log::info('Singpay charge: sending', [
            'trace' => $trace,
            'type' => $type,
            'entity_id' => $entity->id,
            'reference' => $reference,
            'amount' => $amount,
            'endpoint' => config('services.singpay.base_url'),
            'msisdn' => $this->maskPhone($entity->phone),
            'reused_pending' => $payment !== null,
        ]);

        try {
            $response = $this->charge($type, $entity, $reference, $amount);
        } catch (\Throwable $e) {
            // Connection refused / DNS / timeout: never surface a 500 here.
            Log::error('Singpay charge: transport failure', [
                'trace' => $trace,
                'reference' => $reference,
                'error' => $e->getMessage(),
            ]);

            return ['ok' => false, 'link' => null, 'reason' => 'transport'];
        }

        $decoded = json_decode($response->body());
        $link = $decoded->link ?? null;

        Log::info('Singpay charge: response', [
            'trace' => $trace,
            'reference' => $reference,
            'http_status' => $response->status(),
            'has_link' => $link !== null,
            // Truncated body, useful to identify the PSP's error contract.
            'body' => Str::limit((string) $response->body(), 500),
        ]);

        // A decodable body is NOT success: an error payload (HTTP 401/422 with
        // JSON) used to be treated as success, producing redirect(null).
        if (! $response->successful() || empty($link)) {
            Log::warning('Singpay charge: rejected by gateway', [
                'trace' => $trace,
                'reference' => $reference,
                'http_status' => $response->status(),
            ]);

            return ['ok' => false, 'link' => null, 'reason' => 'gateway'];
        }

        if (! $payment) {
            $this->persistPendingPayment($type, $entity, $reference, $amount);
        }

        return ['ok' => true, 'link' => $link, 'reason' => null];
    }

    /** Names of the required config keys that are not set. */
    private function missingConfiguration(): array
    {
        $required = ['base_url', 'client_id', 'client_secret', 'wallet_id'];

        return array_values(array_filter(
            $required,
            fn ($key) => empty(config('services.singpay.' . $key)),
        ));
    }

    /** A PENDING payment already opened for this entity at the same amount. */
    private function existingPendingPayment(string $type, $entity, float $amount): ?Payment
    {
        return Payment::where($type === 'folder' ? 'folder_id' : 'quote_id', $entity->id)
            ->where('status', STATUT_PENDING)
            ->where('amount', $amount)
            ->latest('id')
            ->first();
    }

    /** Keep only the last two digits — logs must not carry a full phone number. */
    private function maskPhone(?string $phone): string
    {
        $phone = (string) $phone;

        return $phone === '' ? '' : str_repeat('*', max(0, strlen($phone) - 2)) . substr($phone, -2);
    }

    /**
     * Build and send the Singpay charge request.
     * Credentials come from config/services.php (env-backed), never hardcoded.
     */
    private function charge(string $type, $entity, string $reference, float $amount)
    {
        $callback = url('/callback-singpay/' . $type . '/' . $entity->id . '/' . $reference);

        return Http::withHeaders([
            'x-wallet' => config('services.singpay.wallet_id'),
            'x-client-id' => config('services.singpay.client_id'),
            'x-client-secret' => config('services.singpay.client_secret'),
        ])
            ->timeout(self::TIMEOUT)
            ->connectTimeout(self::CONNECT_TIMEOUT)
            ->post(config('services.singpay.base_url'), [
                'amount' => $amount,
                'client_msisdn' => $entity->phone,
                'portefeuille' => config('services.singpay.wallet_id'),
                'reference' => $reference,
                'redirect_success' => $callback,
                'redirect_error' => $callback,
                'disbursement' => config('services.singpay.disbursement_wallet_id'),
                'logoURL' => asset('images/LogoRSA.png'),
            ]);
    }

    /** Store the PENDING payment for this charge (server-side amount, never the payload). */
    private function persistPendingPayment(string $type, $entity, string $reference, float $amount): void
    {
        $payment = new Payment();

        if ($type === 'folder') {
            $payment->folder_id = $entity->id;
            $payment->description = 'Paiement pour le dossier médical N° ' . $entity->reference;
            $payment->customer_id = auth()->id();
        } else {
            $payment->quote_id = $entity->id;
            $payment->description = 'Frais de demande de devis.';
            $payment->customer_id = $entity->user_id;
        }

        $payment->reference = $reference;
        $payment->amount = $amount;
        $payment->status = STATUT_PENDING;
        $payment->time_out = 30;
        $payment->save();
    }
}
