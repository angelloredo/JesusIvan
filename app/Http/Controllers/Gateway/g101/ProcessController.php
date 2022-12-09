<?php

namespace App\Http\Controllers\Gateway\g101;

use App\Deposit;
use App\GeneralSettings;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProcessController extends Controller
{

    /*
     * Paypal Gateway
     */
    public static function process($deposit)
    {
        $basic = GeneralSettings::first();
        $paypalAcc = json_decode($deposit->gateway_currency()->parameter);
        $send['cleint_id'] = $paypalAcc->cleint_id ?? '';
        $send['description'] = "Payment To $basic->sitename Account";
        $send['custom_id'] = $deposit->trx;
        $send['amount'] = round($deposit->final_amo, 2);
        $send['currency'] = $deposit->method_currency;
        $send['view'] = 'payment.g101';
        return json_encode($send);


    }
    public function ipn(Request $request, $trx = null, $type = null)
    {
        $data = Deposit::where('trx', $trx)->orderBy('id', 'DESC')->first();
        if(!$data){
            abort(404);
        }
        $paypalAcc = json_decode($data->gateway_currency()->parameter);
        $url = "https://api.paypal.com/v2/checkout/orders/{$type}";
        $client_id = $paypalAcc->cleint_id ?? '';
        $secret = $paypalAcc->secret ?? '';
        $headers = [
            'Content-Type:application/json',
            'Authorization:Basic ' . base64_encode("{$client_id}:{$secret}")
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        $paymentData = json_decode($result, true);

        if (isset($paymentData['status']) && $paymentData['status'] == 'COMPLETED') {
            if ($paymentData['purchase_units'][0]['amount']['currency_code'] == $data->method_currency && $paymentData['purchase_units'][0]['amount']['value'] == round($data->final_amo, 2)) {
                PaymentController::userDataUpdate($data->trx);


                session()->flash('success','Transaction was successful.');
                return redirect()->route('payment');
            } else {
                session()->flash('error','Invalid amount.');
                return redirect()->route('payment');
            }
        } else {
            session()->flash('error','Unexpected error!');
        }
        return redirect()->route('payment');
    }
}
