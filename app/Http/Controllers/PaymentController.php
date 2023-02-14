<?php

namespace App\Http\Controllers;

use App\Mail\QuoteAdminMessage;
use App\Mail\QuoteMessage;
use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
            $data->load(['service']);
            $eb_amount = $data->service->price;
            $eb_shortdescription = 'Paiement pour le dossier médical N° ' . $data->reference;
            $eb_reference = $data->reference;
            $eb_email = auth()->user()->email;
            $eb_msisdn = auth()->user()->phone ? auth()->user()->phone : '074010203';
            $eb_callbackurl = url('/callback/ebilling/folder/' . $data->id);
            $eb_name = $data->firstname . ' ' . $data->lastname;
        } else {
            // Fetch all data (including those not optional) from session
            $eb_amount = 50000;
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
        $curl = curl_init(env('SERVER_URL'));
        curl_setopt($curl, CURLOPT_USERPWD, env('USER_NAME') . ":" . env('SHARED_KEY'));
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
        echo "<form action='" . env('POST_URL') . "' method='post' name='frm'>";
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
            $folder = Folder::find($entity);
            $payment = Payment::all()->where('reference', $folder->reference);
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
            $quote = Quote::find($entity);
            $payment = Payment::all()->where('reference', $quote->reference);
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

    public function notify_ebilling()
    {
        if (isset($_POST['reference'])) {
            $payment = Payment::where('reference', $_POST['reference'])->first();
            if ($payment) {
                $payment->status = STATUT_PAID;
                $payment->transaction_id = $_POST['transactionid'];
                $payment->operator = $_POST['paymentsystem'];
                $payment->amount = $_POST['amount'];
                $payment->paid_at = date('Y-m-d H:i');
                if ($payment->save()) {
                    return http_response_code(200);
                } else {
                    return http_response_code(403);
                }
            } else {
                return http_response_code(402);
            }
        } else {
            return http_response_code(401);
        }
    }

    static function singpay($type, $data)
    {

        $eb_reference = Controller::str_random_pay(8);



        if ($type == 'folder') {
            // Fetch all data (including those not optional) from session
            $response = Http::withHeaders([
                'x-wallet' => '61969004de1502d25d2e2de7',
                'x-client-id' => '7fbdcd94-7fa2-45d9-9db4-c165d8200364',
                'x-client-secret' => 'ce88eefaf3f18d65c83187d8197d3a3566515a9dd59dca701f327818e3d8946b'
            ])->post('https://gateway.singpay.ga/v1/ext', [
                "amount" => $data->service->price,
                "client_msisdn" => $data->phone,
                "portefeuille" => env('SING_WALLET', "61969004de1502d25d2e2de7"),
                "reference" => $eb_reference,
                "redirect_success" => url('/callback-singpay/folder/' . $data->id . '/' . $eb_reference),
                "redirect_error" => url('/callback-singpay/folder/' . $data->id . '/' . $eb_reference),
                "disbursement" => "61969004de1502d25d2e2de7",
                "logoURL" => asset('images/LogoRSA.png'),
            ]);
        } else {
            $data->load(['service']);


            // Fetch all data (including those not optional) from session
            $response = Http::withHeaders([
                'x-wallet' => '61968f70de15022d622e2ddd',
                'x-client-id' => '77fbdcd94-7fa2-45d9-9db4-c165d8200364',
                'x-client-secret' => 'ce88eefaf3f18d65c83187d8197d3a3566515a9dd59dca701f327818e3d8946b'
            ])->post('https://gateway.singpay.ga/v1/ext', [
                "amount" => $data->service->price,
                "client_msisdn" => $data->phone,
                "portefeuille" => env('SING_WALLET', "61968f70de15022d622e2ddd"),
                "reference" => $eb_reference,
                "redirect_success" => url('/callback-singpay/quote/' . $data->id . '/' . $eb_reference),
                "redirect_error" => url('/callback-singpay/quote/' . $data->id . '/' . $eb_reference),
                "disbursement" => "61969004de1502d25d2e2de7",
                "logoURL" => asset('images/LogoRSA.png'),
            ]);
        }

        //dd($response);

        $response = json_decode($response->body());

        if ($type == 'folder') {
            $data->load(['service']);
            $eb_amount = $data->service->price + $data->price;
            $eb_shortdescription = 'Paiement pour le dossier médical N° ' . $data->reference;
            $data = [
                'folder_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => 30,
                'customer_id' => Auth::user()->id,
                'description' => $eb_shortdescription,
            ];
        } else {
            $eb_amount = 100;
            $eb_shortdescription = 'Frais de demande de devis.';
            $data = [
                'quote_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => 30,
                'customer_id' => $data->user_id,
                'description' => $eb_shortdescription,
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
            $folder = Folder::find($entity);
            $payment = Payment::all()->where('reference', $payment)->first();
            if (isset($payment->status) && $payment->status == STATUT_PAID) {
                $folder->status = STATUT_PAID;
                $folder->save();
                $folder->load(['payment']);
                return view(
                    'payment.callback',
                    [
                        'folder' => $folder,
                        'payment' => $payment,
                    ]
                )->with('success', 'Votre paiment a bien été reçu.');
            } else {
                return redirect('/profil')->with('error', "Une erreur s'est produite, Veuillez réessayer !");;
            }
        } else {
            $quote = Quote::find($entity);
            $payment = Payment::all()->where('reference',  $payment)->first();
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
                    ]
                )->with('success', "Votre paiment a bien été reçu.");
            } else {
                return redirect('/profil')->with('error', "Votre paiement n'a pas été reçu.");
            }
        }
    }

    public function notify_singpay(Request $request)
    {
        if ($request->input('transaction.reference')) {
            $payment = Payment::where('reference', $request->input('transaction.reference'))->first();
            if ($payment) {
                $payment->status = STATUT_PAID;
                $payment->transaction_id = $request->input('transaction.id');
                $payment->operator = "airtelmoney";
                $payment->amount = $request->input('transaction.amount');
                $payment->paid_at = date('Y-m-d H:i');
                if ($payment->save()) {
                    return http_response_code(200);
                } else {
                    return http_response_code(403);
                }
            } else {
                return http_response_code(402);
            }
        } else {
            return http_response_code(401);
        }
    }
}
