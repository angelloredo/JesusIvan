<?php

namespace App\Http\Controllers\Gateway\g503;

use App\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gateway\PaymentController;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /*
     * CoinPaymentHosted Gateway
     */

    public static function process($deposit)
    {

        $coinPayAcc = json_decode($deposit->gateway_currency()->parameter);

        if ($deposit->btc_amo == 0 || $deposit->btc_wallet == "") {
            $cps = new CoinPaymentHosted();
            $cps->Setup($coinPayAcc->private_key, $coinPayAcc->public_key);
            $callbackUrl = route('g503');

            $req = array(
                'amount' => $deposit->final_amo,
                'currency1' => 'USD',
                'currency2' => $deposit->method_currency,
                'custom' => $deposit->trx,
                'ipn_url' => $callbackUrl,
            );

            $result = $cps->CreateTransaction($req);
            if ($result['error'] == 'ok') {
                $bcoin = sprintf('%.08f', $result['result']['amount']);
                $sendadd = $result['result']['address'];
                $deposit['btc_amo'] = $bcoin;
                $deposit['btc_wallet'] = $sendadd;
                $deposit->update();
            } else {
                $send['error'] = true;
                $send['message'] = $result['error'];
            }
        }

        $send['amount'] = $deposit->btc_amo;
        $send['sendto'] = $deposit->btc_wallet;
        $send['img'] = cryptoQR($deposit->btc_wallet, $deposit->btc_amo);
        $send['currency'] = "$deposit->method_currency";
        $send['view'] = 'payment.crypto';
        return json_encode($send);
    }

    public function ipn(Request $request)
    {
        $input = fopen("php://input", "r");
        @file_put_contents(time().'_coinpayment_crypto.txt', $input);
     
        $postdata = file_get_contents("php://input");
     
        $arr = array();
        parse_str($postdata, $arr);
        extract($arr);
      
          if($arr){
                $track = $arr['custom'];
                $data = Deposit::where('trx', $track)->orderBy('id', 'DESC')->firstOrFail();
                $coinPayAcc = json_decode($data->gateway_currency()->parameter);
               if ($data->method_currency == $arr['currency2'] && $data->btc_amo <= $amount2  && $coinPayAcc->merchant_id == $arr['merchant'] && $data->status == '0') {              
                    PaymentController::userDataUpdate($data->trx);
                }
          }
        
    }
}
