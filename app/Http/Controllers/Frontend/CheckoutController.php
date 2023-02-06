<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\RazorpayController;
use App\Mail\OrderMail;
use App\Mail\OrderMailAdmin;
use App\Models\Admin;
use App\Models\CustomAttribute;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        if (!session()->has('cart')) {
            return back()->with('error', 'Please add some items in your cart.');
        }
        return view('frontend.pages.checkout.checkout', compact('user'));
    }

    public function checkoutStore(Request $request)
    {


        if ($request->has('different-address')) {
            $this->validate($request, [
                'first_name' => 'bail|string|required',
                'last_name' => 'bail|string|required',
                'email' => 'bail|email|required',
                'phone' => 'required',
                'address' => 'bail|string|required',
                'address2' => 'string|nullable',
                'country' => 'string|required',
                'state' => 'string|nullable',
                'postcode' => 'numeric|nullable',
                'note' => 'string|nullable',
                'saddress' => 'string|required',
                'saddress2' => 'string|nullable',
                'scountry' => 'bail|string|required',
                'sstate' => 'string|nullable',
                'spostcode' => 'numeric|nullable',
            ], [
                'saddress.required' => 'The shipping address is required',
                'saddress2.string' => 'The shipping address2 must be string',
                'scountry.required' => 'The shipping country is required',
                'sstate.string' => 'The shipping state must be string',
                'spostcode.numeric' => 'The shipping postcode must be numeric',
            ]);
        } else {
            $this->validate($request, [
                'first_name' => 'bail|string|required',
                'last_name' => 'bail|string|required',
                'email' => 'bail|email|required',
                'phone' => 'required',
                'address' => 'bail|string|required',
                'address2' => 'string|nullable',
                'country' => 'string|required',
                'state' => 'string|nullable',
                'postcode' => 'numeric|nullable',
                'note' => 'string|nullable',
            ]);
        }



        if ($request->payment_method) {
            $orderController = new OrderController;
            $orderController->store($request);
            if ($request->session()->get('order_id')) {
                if ($request->input('payment_method') == 'paypal') {
                    $paypal = new PaypalController;
                    return $paypal->getCheckout();
                } elseif ($request->input('payment_method') == 'stripe') {
                    $this->payWithStripe($request->input('stripeToken'));
                } elseif ($request->input('payment_method') == 'razor') {
                    $razor = new RazorpayController;
                    return $razor->razorpay();
                } elseif ($request->payment_method == 'cod') {

                    $order = Order::findOrFail($request->session()->get('order_id'));
                    $array['view'] = 'mail.invoice';
                    $array['subject'] = 'Your order has been placed -' . $order['order_number'];
                    $array['admin_subject'] = 'You have new order from -' . $order['order_number'];
                    $array['from'] = env('MAIL_FROM_ADDRESS','info@ketramart.com');
                    $array['order'] = $order;

                    if (env('MAIL_USERNAME') != null) {
                        try {
                            Mail::to($order['email'])->send(new OrderMail($array));

                            Mail::to(Admin::first()->email)->send(new OrderMailAdmin($array));
                        } catch (\Exception $e) {
                        }
                    }

                    session()->forget('cart');
                    session()->forget('comment');
                    session()->forget('coupon_code');
                    session()->forget('coupon_discount');
                    session()->forget('shipping_method_id');
                    return redirect()->route('order.complete')->with('success', 'Your order has been placed successfully');
                } else {
                }
            }
        }
    }

    // PAY WITH STRIPE
    public function payWithStripe($token)
    {
        $order = Order::findOrFail(session()->get('order_id'));

        $amount = $order->total_amount;

        $secret_ID = env('STRIPE_SECRET');
        Stripe::setApiKey($secret_ID);
        try {
            $payment = Charge::create([
                "amount" => $amount * 100, // currency in cent to dollar;
                "currency" => session('system_default_currency_info')->code,
                "source" => $token,
                "description" => "Purchase on " . get_settings('site_title'),
            ]);

            $this->checkout_done($order->id, 'Paid with STRIPE', 'stripe');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Error! Please try again.');
        }
    }


    public function checkout_done($order_id, $paymentDetails = '', $paymentMethod)
    {
        $order = Order::findOrFail($order_id);
        if ($paymentMethod == 'cod') {
            $order->payment_status = 'unpaid';
        } else {
            $order->payment_status = 'paid';
        }
        $order->payment_method = $paymentMethod;
        $order->payment_details = $paymentDetails;
        $status = $order->save();

        if ($status) {
            $array['view'] = 'mail.invoice';
            $array['subject'] = 'Your order has been placed -' . $order['order_number'];
            $array['from'] = env('MAIL_FROM_ADDRESS','info@ketramart.com');
            $array['admin_subject'] = 'You have new order from -' . $order['order_number'];
            $array['order'] = $order;

            if (env('MAIL_USERNAME')) {
                try {
                    Mail::to($order['email'])->send(new OrderMail($array));

                    Mail::to(Admin::first()->email)->send(new OrderMailAdmin($array));
                } catch (\Exception $e) {
                    return back()->with('error', $e->getMessage());
                }
            }

            session()->forget('cart');
            session()->forget('comment');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('shipping_method_id');
            return redirect()->route('order.complete')->with('success', 'Your order has been placed successfully');
        } else {
            return back()->with('error', 'Something went wrong!, please try again.');
        }
    }

    public function complete($order)
    {
        $order = Order::where('order_number', $order)->first();
        return view('frontend.pages.checkout.complete', compact('order'));
    }
}
