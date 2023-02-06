<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\CheckoutController;
use App\Models\Currency;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class PaypalController extends Controller
{
    public function getCheckout()
    {
        //creating an environment

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_settings('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        } else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }

        $client = new PayPalHttpClient($environment);

        $order = Order::findOrFail(session()->get('order_id'));
        $amount = $order->total_amount;

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = [
            "intent" => "CAPTURE",
            'purchase_units' => [[
                "reference_id" => rand(000000, 999999),
                "amount" => [
                    "value" => number_format($amount, 2, '.', ''),
                    "currency_code" => session('system_default_currency_info')->code
                ]
            ]],
            "application_context" => [
                "cancel_url" => url('paypal/payment/cancel'),
                "return_url" => url('paypal/payment/done')
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            return Redirect::to($response->result->links[1]->href);
        } catch (HttpException $ex) {
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    public function getCancel(Request $request)
    {
        // Curse and humiliate the user for cancelling this most sacred payment (yours)
        $request->session()->forget('order_id');
        return \redirect()->route('home')->with('error', 'Sorry Payment cancelled');
    }

    public function getDone(Request $request)
    {
        //creating an environment

        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_CLIENT_SECRET');

        if (get_settings('paypal_sandbox') == 1) {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        } else {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        }

        $client = new PayPalHttpClient($environment);

        // $response->result->id gives the orderId of the order created above
        $orderCaptureRequest = new OrdersCaptureRequest($request->token);
        $orderCaptureRequest->prefer('return=representation');

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($orderCaptureRequest);
            // If call returns body in response, you can get the deserialized version from the result attribute of the response

            $checkoutController = new CheckoutController;
            return $checkoutController->checkout_done($request->session()->get('order_id'), json_encode($response),'paypal');
        } catch (\HttpException $ex) {
        }
    }
}
