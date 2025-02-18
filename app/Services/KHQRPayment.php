<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Session;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class KHQRPayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data,  array $configInput)
    {
        try {
            $response = PaymentGateway::query()->where('name', 'khqr')->first();
            $url = json_decode($response->config);
            return  redirect()->away($url->key);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
