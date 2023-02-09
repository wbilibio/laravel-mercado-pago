<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payer.first_name' => 'required|string',
            'payer.last_name' => 'required|string',
            'payer.email' => 'required|string',
            'payer.identification.type' => 'required|string',
            'payer.identification.number' => 'required|numeric',
            'payer.address.zip_code' => 'required|string|min:9',
            'payer.address.street_name' => 'required|string',
            'payer.address.street_number' => 'required|numeric',
            'payer.address.neighborhood' => 'required|string',
            'payer.address.city' => 'required|string',
            'payer.address.federal_unit' => 'required|string',
            'additional_info.payer.phone.area_code' => 'required|numeric|min:2',
            'additional_info.payer.phone.number' => 'required|numeric|min:9',
            'additional_info.items' => 'array',
            'payment_method_id' => 'required|string',
            'transaction_amount' => 'required|numeric',
            'installments' => 'required_if:payment_method_id,visa|required_if:payment_method_id,elo|required_if:payment_method_id,master',
            'token_card' => 'required_if:payment_method_id,visa|required_if:payment_method_id,elo|required_if:payment_method_id,master',
            'issuer_id' => 'required_if:payment_method_id,visa|required_if:payment_method_id,elo|required_if:payment_method_id,master',
        ];
    }
}
