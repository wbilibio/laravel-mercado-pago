<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Payer;

class ApiMercadoPago extends Controller
{
    public function __construct()
    {
        SDK::setAccessToken(env('MP_ACCESS_TOKEN'));
    }
    public function createPayment(Object $data): Payment
    {
        $data->additional_info["payer"]["first_name"] = $data->payer["first_name"];
        $data->additional_info["payer"]["last_name"] = $data->payer["last_name"];
        $data->additional_info["payer"]["registration_date"] = Carbon::now();

        $payment = new Payment();
        $payment->transaction_amount = (float)$data->transaction_amount;
        $payment->additional_info = $data->additional_info;
        $payment->payment_method_id = $data->payment_method_id;

        if($payment->payment_method_id !== "bolbradesco") {
            $payment->token = $data->token_card;
            $payment->installments = $data->installments;
            $payment->issuer_id = $data->issuer_id;
        }

        $payment->payer = $this->createPayer($data);

        $payment->save();

        return $payment;
    }

    public function createPayer($data){
        $payer = new Payer();
        $payer->first_name = $data->payer["first_name"];
        $payer->last_name = $data->payer["last_name"];
        $payer->email = $data->payer["email"];
        $payer->identification = array(
            "type" => $data->payer["identification"]["type"],
            "number" => $data->payer["identification"]["number"]
        );
        $payer->address = $data->payer["address"];
        return $payer;
    }

}
