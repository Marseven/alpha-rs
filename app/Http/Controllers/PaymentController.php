<?php

namespace App\Http\Controllers;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Quote;
use App\Services\PaymentAmountResolver;
use App\Services\PaymentWebhookVerifier;
use App\Services\Payments\EbillingProvider;
use App\Services\Payments\PaymentProviderInterface;
use App\Services\Payments\SingpayProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

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

    static function create($type, $data)
    {

        $payment = new Payment();
        if ($type == 'folder') $payment->folder_id = $data['folder_id'];
        if ($type == 'quote') $payment->quote_id = $data['quote_id'];
        $payment->description = $data['description'];
        $payment->reference = $data['reference'];
        $payment->amount = $data['amount'];
        $payment->status = $data['status'];
        $payment->time_out = $data['time_out'];
        $payment->customer_id = $data['customer_id'];

        return $payment->save();
    }

    static function ebilling($type, $data)
    {

        // =============================================================
        // ===================== Setup Attributes ===========================
        // =============================================================

        if ($type == 'folder') {
            // Fetch all data (including those not optional) from session
            $data->loadMissing(['service']);
            $eb_amount = PaymentAmountResolver::forFolder($data);
            $eb_shortdescription = 'Paiement pour le dossier médical N° ' . $data->reference;
            $eb_reference = $data->reference;
            $eb_email = auth()->user()->email;
            $eb_msisdn = auth()->user()->phone ? auth()->user()->phone : '074010203';
            $eb_callbackurl = url('/callback/ebilling/folder/' . $data->id);
            $eb_name = $data->firstname . ' ' . $data->lastname;
        } else {
            // Fetch all data (including those not optional) from session
            $eb_amount = PaymentAmountResolver::forQuote($data);
            $eb_shortdescription = 'Frais de demande de devis.';
            $eb_reference = $data->reference;
            $eb_email = $data->email;
            $eb_msisdn = $data->phone;
            $eb_callbackurl = url('/callback/ebilling/quote/' . $data->id);
            $eb_name = $data->firstname . ' ' . $data->lastname;
        }

        $expiry_period = 60; // 60 minutes timeout

        // Creating invoice for a merchant
        $merchant_name = config('app.name');

        // =============================================================
        // ============== E-Billing server invocation ==================
        // =============================================================

        $invoice = [
            'payer_email' => $eb_email,
            'payer_msisdn' => $eb_msisdn,
            'amount' => $eb_amount,
            'short_description' => $eb_shortdescription,
            'external_reference' => $eb_reference,
            'payer_name' => $eb_name,
            'expiry_period' => $expiry_period
        ];

        $e_bills[] = $invoice;

        $global_array =
            [
                'merchant_name' => $merchant_name,
                'e_bills' => $e_bills,
                'expiry_period' => $expiry_period
            ];

        $content = json_encode($global_array);
        $curl = curl_init(config('services.ebilling.base_url'));
        curl_setopt($curl, CURLOPT_USERPWD, config('services.ebilling.username') . ":" . config('services.ebilling.shared_key'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);

        // Get status code
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Check status <> 200
        if ($status < 200  || $status > 299) {
            die("Error: call to URL failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);

        // Get response in JSON format
        $response = json_decode($json_response, true);

        // Get unique transaction id
        $bill_id = $response['e_bills'][0]['bill_id'];

        if ($type == 'folder') {
            $data = [
                'folder_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => $expiry_period,
                'customer_id' => Auth::user()->id,
                'description' => $eb_shortdescription,
            ];
        } else {
            $data = [
                'quote_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => $expiry_period,
                'customer_id' => $data->user_id,
                'description' => $eb_shortdescription,
            ];
        }

        PaymentController::create($type, $data);

        // Redirect to E-Billing portal
        echo "<form action='" . config('services.ebilling.post_url') . "' method='post' name='frm'>";
        echo "<input type='hidden' name='invoice_number' value='" . $bill_id . "'>";
        echo "<input type='hidden' name='eb_callbackurl' value='" . $eb_callbackurl . "'>";
        echo "</form>";
        echo "<script language='JavaScript'>";
        echo "document.frm.submit();";
        echo "</script>";

        exit();
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
     * Build the request to the Singpay gateway. Credentials come from
     * config/services.php (env-backed), never from hardcoded values.
     */
    private static function singpayRequest($type, $data, $eb_reference, $amount)
    {
        $callback = url('/callback-singpay/' . $type . '/' . $data->id . '/' . $eb_reference);

        return Http::withHeaders([
            'x-wallet' => config('services.singpay.wallet_id'),
            'x-client-id' => config('services.singpay.client_id'),
            'x-client-secret' => config('services.singpay.client_secret'),
        ])->post(config('services.singpay.base_url'), [
            "amount" => $amount,
            "client_msisdn" => $data->phone,
            "portefeuille" => config('services.singpay.wallet_id'),
            "reference" => $eb_reference,
            "redirect_success" => $callback,
            "redirect_error" => $callback,
            "disbursement" => config('services.singpay.disbursement_wallet_id'),
            "logoURL" => asset('images/LogoRSA.png'),
        ]);
    }

    static function singpay($type, $data)
    {

        $eb_reference = Controller::str_random_pay(8);

        $data->loadMissing(['service']);

        // Single authoritative amount: charged at the gateway AND stored, so
        // the webhook amount-check is consistent across providers.
        $eb_amount = PaymentAmountResolver::for($type, $data);

        $response = self::singpayRequest($type, $data, $eb_reference, $eb_amount);

        $response = json_decode($response->body());

        if ($type == 'folder') {
            $eb_shortdescription = 'Paiement pour le dossier médical N° ' . $data->reference;
            $data = [
                'folder_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => 30,
                'customer_id' => Auth::user()->id,
            ];
        } else {
            $eb_shortdescription = 'Frais de demande de devis.';
            $data = [
                'quote_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => 30,
                'customer_id' => $data->user_id,
            ];
        }

        PaymentController::create($type, $data);

        if ($response != null) {
            return redirect($response->link);
        } else {
            return back()->with('error', "Une erreur s'est produite, veuillez réessayer plus tard.")->withInput();
        }
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
                } catch (Swift_TransportException $e) {
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
