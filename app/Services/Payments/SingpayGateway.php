<?php

namespace App\Services\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\PaymentAmountResolver;
use Illuminate\Support\Facades\Http;

/**
 * Outbound Singpay charge initiation.
 *
 * Extracted from PaymentController to keep that controller thin. Persists a
 * PENDING payment with the server-resolved amount (so the webhook amount-check
 * stays authoritative) and reports the gateway redirect link. This is a
 * behaviour-preserving move of the former PaymentController::singpay() /
 * singpayRequest() logic — the same HTTP request is issued and the same
 * success/failure branches are reported.
 */
class SingpayGateway
{
    /**
     * Initiate a charge for a Folder or Quote and persist the pending payment.
     *
     * @param  string  $type    'folder' | 'quote'
     * @param  mixed   $entity   Folder or Quote model
     * @return array{ok: bool, link: string|null}  ok = the gateway answered with
     *         a decodable body; link = the redirect URL it returned (may be null).
     */
    public function initiate(string $type, $entity): array
    {
        $reference = Controller::str_random_pay(8);

        $entity->loadMissing(['service']);

        // Single authoritative amount: charged at the gateway AND stored, so the
        // webhook amount-check is consistent across providers.
        $amount = PaymentAmountResolver::for($type, $entity);

        $decoded = json_decode($this->charge($type, $entity, $reference, $amount)->body());

        $this->persistPendingPayment($type, $entity, $reference, $amount);

        return [
            'ok' => $decoded !== null,
            'link' => $decoded->link ?? null,
        ];
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
        ])->post(config('services.singpay.base_url'), [
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
