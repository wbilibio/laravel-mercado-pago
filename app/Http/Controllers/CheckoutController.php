<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckoutRequest;
use App\Http\Controllers\Apis\ApiMercadoPago;

/**
 * @property ApiMercadoPago $apiMercadoPago
 */
class CheckoutController extends Controller
{

    public function __construct(ApiMercadoPago $apiMercadoPago)
    {
        $this->apiMercadoPago = $apiMercadoPago;
    }

    public function show()
    {
        return view('checkout.index');
    }

    public function store(StoreCheckoutRequest $request)
    {
        $validated = $request->validated();
        try {
            $response = $this->apiMercadoPago->createPayment((object)$validated);

            if(!$response->error){
                return redirect('checkout/sucesso');
            } else {
                return back()->with('error', 'Pagamento nao realizado');
            }
        } catch (\Exception $e) {
            report($e);

            return back()->with('error', 'Pagamento nao realizado');
        }

    }

    public function success()
    {
        return view('checkout.success.index');
    }
}
