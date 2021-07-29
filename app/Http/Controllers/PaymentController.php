<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Refill;
use App\Models\Card;
use App\Models\Folder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Quote;
use App\Models\RequestCard;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['payments']);
        return view('payment.list',
        [
            'payments' => $user->payments,
        ]);
    }

    public function payments()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['payments']);
        return view('payment.list',
        [
            'payments' => $user->payments,
        ]);
    }

    static function create($type, $data)
    {

    	$payment = new Payment();
    	if($type == 'refill') $payment->refill_id = $data['refill'];
        $payment->description = $data['description'];
        $payment->reference = $data['reference'];
        $payment->amount = $data['amount'];
        $payment->status = $data['status'];
        $payment->time_out = $data['time_out'];
        $payment->customer_id = $data['customer_id'];

    	return $payment->save();
    }

    static function ebilling($type, $data){

        // =============================================================
        // ===================== Setup Attributes ===========================
        // =============================================================

        if($type == 'folder'){
            // Fetch all data (including those not optional) from session
            $eb_amount = $data->amount;
            $eb_shortdescription = 'Paiement pour le dossier médical N° '.$data->reference;
            $eb_reference = $data->reference;
            $eb_email = auth()->user()->email;
            $eb_msisdn = auth()->user()->phone ? auth()->user()->phone :'074010203';
            $eb_callbackurl = url('/callback/ebilling/folder/'.$data->id);
            $eb_name = $data->firstname.' '.$data->lastname;
        }else{
            // Fetch all data (including those not optional) from session
            $eb_amount = 100;
            $eb_shortdescription = 'Frais de demande de devis.';
            $eb_reference = $data->reference;
            $eb_email = $data->email;
            $eb_msisdn = $data->phone;
            $eb_callbackurl = url('/callback/ebilling/quote/'.$data->id);
            $eb_name = $data->firstname.' '.$data->lastname;
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
        if ( $status < 200  || $status > 299  ) {
            die("Error: call to URL failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);

        // Get response in JSON format
        $response = json_decode($json_response, true);

        // Get unique transaction id
        $bill_id = $response['e_bills'][0]['bill_id'];

        if($type == 'folder'){
            $data = [
                'folder' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => STATUT_PENDING,
                'time_out' => $expiry_period,
                'customer_id' => Auth::user()->id,
                'description' => $eb_shortdescription,
            ];
        }else{
            $data = [
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
        echo "<input type='hidden' name='invoice_number' value='".$bill_id."'>";
        echo "<input type='hidden' name='eb_callbackurl' value='".$eb_callbackurl."'>";
        echo "</form>";
        echo "<script language='JavaScript'>";
        echo "document.frm.submit();";
        echo "</script>";

        exit();
    }

    static function callback_ebilling($type, $entity){
        if($type == 'folder'){
            $folder = Folder::find($entity);
            $folder->status = STATUT_PENDING;
            $folder->save();
            $folder->load(['payment']);
            $payment = Payment::all()->where('reference', $folder->reference);
            if(isset($payment->status) && $payment->status == STATUT_PAID){
                return view('payment.callback',
                [
                    'folder' => $folder,
                ])->with('succes','Votre paiment a bien été reçu.');
            }else{
                return redirect('/refill')->with('error',"Une erreur s'est produite, Veuillez réessayer !");;
            }
        }else{
            $quote = Quote::find($entity);
            $payment = Payment::all()->where('reference', $quote->reference);
            if(isset($payment->status) && $payment->status == STATUT_PAID){
                return view('payment.callback-request',
                [
                    'quote' => $quote,
                ])->with('succes','Votre paiment a bien été reçu. Vérifiez votre boîte mail pour réinitialiser votre mot de passe.');
            }else{
                return redirect('/request-card')->with('succes',"Votre paiement n'a pas été reçu, Vérifiez votre boîte mail pour réinitialiser votre mot de passe.");
            }
        }
    }

    static function notify_ebilling(){
        if($_POST['reference']){
            $payment = Payment::where('reference', $_POST['reference']);
            $payment->status = STATUT_PAID;
            $payment->transaction_id = $_POST['transaction_id'];
            $payment->operator = $_POST['paymentsystem'];
            $payment->amount = $_POST['amount'];
            $payment->paid_at = date('Y-m-d H:i');
	    	if($payment->save()){
                return http_response_code(200);
            }else{
                return http_response_code(402);
            }
        }else{
            return http_response_code(401);
        }

    }
}
