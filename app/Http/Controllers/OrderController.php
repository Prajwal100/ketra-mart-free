<?php

namespace App\Http\Controllers;
/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2023                                  =
==========================================*/
use App\Mail\OrderMail;
use App\Mail\OrderStatus;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\OrdersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function export(){
        return Excel::download(new OrdersExport(),'orders.xlsx');
    }
    public function invoiceDownload($id){
        $order=Order::findOrFail($id);
        return PDF::loadView('backend.order.invoice',[
            'order' => $order,
        ], [], [])->download('order-'.$order->order_number.'.pdf');
    }
    public function index()
    {
        $orders=Order::latest()->get();
        return view('backend.order.index',compact('orders'));
    }

    public function pendingOrder()
    {
        $orders=Order::where('order_status','pending')->get();
        return view('backend.order.index',compact('orders'));
    }

    public function processOrder()
    {
        $orders=Order::where('order_status','process')->get();
        return view('backend.order.index',compact('orders'));
    }

    public function deliveredOrder()
    {
        $orders=Order::where('order_status','delivered')->get();
        return view('backend.order.index',compact('orders'));
    }

    public function cancelledOrder()
    {
        $orders=Order::where('order_status','cancelled')->get();
        return view('backend.order.index',compact('orders'));
    }


    //order status update here
    public function orderStatus(Request $request){
        $order=Order::where('id',$request->input('order_id'))->first();
        if($request->input('order_status')=='delivered'){
            foreach($order->orderDetails as $item){
                $product= Product::where('id',$item->product_id)->first();

                $stock=$product->current_stock;
                $stock -=$item->quantity;
                $product->update(['current_stock'=>$stock]);
                if($order->payment_status =='unpaid'){
                   $order->update(['payment_status'=>'paid']);
                }
            }
        }
        $status=$order->update(['order_status'=>$request->input('order_status')]);
        if($status){
            $array['view']='mail.order-status';
            $array['subject']='Your order status -'.$order['order_number'];
            $array['order']=$order;
            Mail::to($order->email)->send(new OrderStatus($array));

            $notify[]=['success','Order status has been updated'];
            return back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong'];
            return redirect()->back()->withNotify($notify);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart=session('cart');
        $ship_to_diff_adr=0;
        if($request->has('different-address')) {
            $ship_to_diff_adr = 1;
        }
        $coupon_discount=session()->has('coupon_discount') ? session('coupon_discount') : 0;


        $order=new Order();

        $order['user_id']=auth()->user()->id;

        //serial order number
        $orderObj = DB::table('orders')->select('order_number')->latest('id')->first();
        if ($orderObj) {
            $orderNr = $orderObj->order_number;

            $removed1char = substr($orderNr, 6);

            $generateOrder_nr = $stpad = 'KETRA-' . str_pad($removed1char + 1, 3, "0", STR_PAD_LEFT);
        } else {
            $generateOrder_nr=Str::upper('KETRA-'. str_pad(1, 4, "0", STR_PAD_RIGHT));
        }

        $order['order_number']=$generateOrder_nr;

        $order['coupon']=$coupon_discount;
        $order['quantity']=count($cart);
        $order['subtotal']=Order::cart_grand_total($cart);
        $order['total_amount']=Order::cart_grand_total($cart)-$coupon_discount+Order::total_shipping_cost($cart);
        $order['payment_method']=$request->payment_method;
        $order['payment_status']='unpaid';
        $order['order_status']='pending';
        $order['delivery_charge']=Order::total_shipping_cost($cart);
        $order['note']=$request->note;
        $order->first_name=$request->first_name;
        $order->last_name=$request->last_name;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->country=$request->country;
        $order->address=$request->address;
        $order->address2=$request->address;
        $order->state=$request->state;
        $order->postcode=$request->postcode;

        $order->scountry=$ship_to_diff_adr=='1' ? $request->scountry : $request->country;
        $order->saddress=$ship_to_diff_adr=='1' ? $request->saddress : $request->address;
        $order->saddress2=$ship_to_diff_adr=='1' ? $request->saddress2 : $request->address2;
        $order->sstate=$ship_to_diff_adr=='1' ? $request->sstate : $request->state;
        $order->spostcode=$ship_to_diff_adr=='1' ? $request->spostcode : $request->postcode;

        if($order->save()){
            $subtotal=0;

            //Order detail storing
            foreach(session()->get('cart') as $key=>$cartItem){
                $product=Product::find($cartItem['id']);
                $subtotal+=$cartItem['price']*$cartItem['quantity'];

                $order_detail=new OrderDetail();

                $order_detail->order_id=$order->id;
                $order_detail->product_id=$product->id;
                $order_detail->product_details=$product;
                $order_detail->variation=$cartItem['variation'];
                $order_detail->price=$cartItem['price']*$cartItem['quantity'];
                $order_detail->quantity=$cartItem['quantity'];
                $order_detail->discount=$cartItem['discount']*$cartItem['quantity'];
                $order_detail->shipping_method_id=$cartItem['shipping_method_id'];

                $order_detail->save();
            }

            $status=$order->save();

            if($status){
                $request->session()->put('order_id',$order->id);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::findOrFail($id);
        if($order){
            return view('backend.order.show',compact('order'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(demoCheck()){
            return redirect()->back();
        }
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                $notify[]=['success','Order successfully deleted'];
                return redirect()->route('orders.index')->withNotify($notify);
            }
            else{
                $notify[]=['error','Something went wrong'];
                return redirect()->back()->withNotify($notify);
            }
        }
        else{
            $notify[]=['warning','Data not found'];
            return back()->withNotify($notify);
        }
    }
}
