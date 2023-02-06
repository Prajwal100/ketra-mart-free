<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\CheckoutController;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function razorpay()
    {
        $order=Order::findOrFail(session()->get('order_id'));

        return view('frontend.pages.checkout.razor',compact('order'));
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id']))
        {
            $payment_detalis = null;
            try
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

                $payment_detalis = json_encode(array('id' => $response['id'],'method' => $response['method'],'amount' => $response['amount'],'currency' => $response['currency']));
            }
            catch (\Exception $e)
            {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        $checkoutController=new CheckoutController;
        return $checkoutController->checkout_done(Session::get('order_id'),$payment_detalis,'razor');
    }
}
