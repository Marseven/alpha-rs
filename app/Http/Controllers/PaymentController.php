<?php

namespace App\Http\Controllers;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Quote;
use App\Services\PaymentWebhookVerifier;
use App\Services\Payments\EbillingProvider;
use App\Services\Payments\PaymentProviderInterface;
use App\Services\Payments\SingpayGateway;
use App\Services\Payments\SingpayProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['payments']);
        return view(
            'payment.list',
            [
                'payments' => $user->payments,
                'title' => 'Paiement'
            ]
        );
    }

    public function payments()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['payments']);
        return view(
            'payment.list',
            [
                'payments' => $user->payments,
                'title' => 'Paiement'
            ]
        );
    }

    public function callback_ebilling($type, $entity)
    {
        if ($type == 'folder') {
            $folder = Folder::findOrFail($entity);
            $this->authorize('view', $folder);
            $payment = Payment::where('reference', $folder->reference)->first();
            if (isset($payment->status) && $payment->status == STATUT_PAID) {
                $folder->status = STATUT_PAID;
                $folder->save();
                $folder->load(['payment']);
                return view(
                    'payment.callback',
                    [
                        'folder' => $folder,
                    ]
                )->with('success', 'Votre paiment a bien été reçu.');
            } else {
                return redirect('/profil')->with('error', "Une erreur s'est produite, Veuillez réessayer !");;
            }
        } else {
            $quote = Quote::findOrFail($entity);
            $this->authorize('view', $quote);
            $payment = Payment::where('reference', $quote->reference)->first();
            if (isset($payment->status) && $payment->status == STATUT_PAID) {
                Mail::to('m.cherone@reliefservices.net')->queue(new QuoteMessage($quote));
                Mail::to($quote->email)->queue(new QuoteMessage($quote));
                return view(
                    'payment.callback-request',
                    [
                        'quote' => $quote,
                    ]
                )->with('success', 'Votre paiment a bien été reçu.');
            } else {
                return redirect('/profil')->with('success', "Votre paiement n'a pas été reçu.");
            }
        }
    }

    public function notify_ebilling(Request $request, PaymentWebhookVerifier $verifier, EbillingProvider $provider)
    {
        if (! $verifier->verify($request)) {
            return response('Invalid signature', 401);
        }

        if (! $request->input('reference')) {
            return response('Bad request', 400);
        }

        return $this->settlePayment(
            $request->input('reference'),
            (float) $request->input('amount'),
            [
                'transaction_id' => $request->input('transactionid'),
                'operator' => $request->input('paymentsystem'),
            ],
            $provider
        );
    }

    /**
     * Initiate a Singpay charge. The gateway HTTP call + pending-payment
     * persistence live in App\Services\Payments\SingpayGateway; this stays a
     * thin adapter that maps the result to a redirect or an error.
     */
    static function singpay($type, $data)
    {
        $result = (new SingpayGateway())->initiate($type, $data);

        if ($result['ok']) {
            return redirect($result['link']);
        }

        return back()->with('error', "Une erreur s'est produite, veuillez réessayer plus tard.")->withInput();
    }

    public function callback_singpay($type, $entity, $payment)
    {
        if ($type == 'folder') {
            $folder = Folder::findOrFail($entity);
            $this->authorize('view', $folder);
            $payment = Payment::where('reference', $payment)->first();
            if (isset($payment->status) && $payment->status == STATUT_PAID) {
                $folder->status = STATUT_PAID;
                $folder->save();
                $folder->load(['payment']);
                return view(
                    'payment.callback',
                    [
                        'folder' => $folder,
                        'payment' => $payment,
                        'title' => 'Paiement'
                    ]
                )->with('success', 'Votre paiment a bien été reçu.');
            } else {
                return redirect('/profil')->with('error', "Une erreur s'est produite, Veuillez réessayer !");;
            }
        } else {
            $quote = Quote::findOrFail($entity);
            $this->authorize('view', $quote);
            $payment = Payment::where('reference',  $payment)->first();
            if (isset($payment->status) && $payment->status == STATUT_PAID) {
                $quote->status = STATUT_PAID;
                $quote->save();
                try {
                    Mail::to("contact@reliefservices.net")->queue(new QuoteAdminMessage($quote));
                    Mail::to(Auth::user()->email)->queue(new QuoteMessage($quote));
                } catch (\Throwable $e) {
                    return view(
                        'payment.callback-request',
                        [
                            'quote' => $quote,
                            'payment' => $payment,
                        ]
                    )->with('success', "Votre paiment a bien été reçu. - " . $e->getMessage());
                }
                return view(
                    'payment.callback-request',
                    [
                        'quote' => $quote,
                        'payment' => $payment,
                        'title' => 'Paiement'
                    ]
                )->with('success', "Votre paiment a bien été reçu.");
            } else {
                return redirect('/profil')->with('error', "Votre paiement n'a pas été reçu.");
            }
        }
    }

    public function notify_singpay(Request $request, PaymentWebhookVerifier $verifier, SingpayProvider $provider)
    {
        if (! $verifier->verify($request)) {
            return response('Invalid signature', 401);
        }

        if (! $request->input('transaction.reference') || $request->input('transaction.result') !== 'Success') {
            return response('Bad request', 400);
        }

        return $this->settlePayment(
            $request->input('transaction.reference'),
            (float) $request->input('transaction.amount'),
            [
                'transaction_id' => $request->input('transaction.id'),
                'operator' => 'airtelmoney',
            ],
            $provider
        );
    }

    /**
     * Apply a verified payment notification:
     *  - the payment must exist,
     *  - the reported amount must match the amount we computed server-side
     *    (we never let the payload set the price),
     *  - only PENDING -> PAID is allowed; an already-paid payment is a no-op
     *    (idempotent), anything else is refused.
     */
    private function settlePayment(string $reference, float $reportedAmount, array $meta, ?PaymentProviderInterface $provider = null)
    {
        $payment = Payment::where('reference', $reference)->first();

        if (! $payment) {
            Log::warning('Payment webhook: unknown reference ' . $reference);
            return response('Unknown reference', 402);
        }

        if ((int) $payment->status === STATUT_PAID) {
            return response('Already processed', 200); // idempotent replay
        }

        if ((int) $payment->status !== STATUT_PENDING) {
            Log::warning('Payment webhook: invalid state transition for ' . $reference);
            return response('Invalid state', 409);
        }

        if (round((float) $payment->amount, 2) !== round($reportedAmount, 2)) {
            Log::warning("Payment webhook: amount mismatch for {$reference} (expected {$payment->amount}, got {$reportedAmount})");
            return response('Amount mismatch', 422);
        }

        // Server-to-server confirmation: never trust the payload alone when
        // inquiry is required. Fails closed when the provider cannot confirm.
        if (config('services.payment.require_provider_inquiry')) {
            if (! $provider) {
                Log::critical("Payment webhook: inquiry required but no provider for {$reference}.");
                return response('Inquiry unavailable', 422);
            }

            $result = $provider->verify($reference);
            if (! $result->successful) {
                Log::warning("Payment webhook: provider inquiry not confirmed for {$reference} ({$result->status}).");
                return response('Inquiry not confirmed', 422);
            }
            if (round($result->amount, 2) !== round((float) $payment->amount, 2)) {
                Log::warning("Payment webhook: inquiry amount mismatch for {$reference} (expected {$payment->amount}, got {$result->amount}).");
                return response('Inquiry amount mismatch', 422);
            }
        }

        $payment->status = STATUT_PAID;
        $payment->transaction_id = $meta['transaction_id'] ?? null;
        $payment->operator = $meta['operator'] ?? null;
        $payment->paid_at = date('Y-m-d H:i:s');
        $payment->save();

        Log::info('Payment settled via webhook: ' . $reference);

        return response('OK', 200);
    }
}
