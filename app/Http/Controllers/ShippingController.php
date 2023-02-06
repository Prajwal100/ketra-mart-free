<?php

namespace App\Http\Controllers;
/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2023                                  =
==========================================*/
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShippingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function setShippingMethod(Request $request){
        if($request['id'] !=0){
            session()->put('shipping_method_id',$request['id']);
            $cart = $request->session()->get('cart', collect([]));
            $cart = $cart->map(function ($object, $key) use ($request) {
                if ($key == $request['key']) {
                    $object['shipping_method_id'] = $request['id'];
                    $object['shipping_cost'] = Shipping::find($request['id'])->delivery_charge;
                }
                return $object;
            });
            $request->session()->put('cart', $cart);
            $cart_list=view('frontend.layouts._cart-lists')->render();

            $user=Auth::check() ? Auth::user() : null;
            $checkout=view('frontend.pages.checkout._inner_checkout',compact('user'))->render();
            return response()->json([
                'data'=>$cart_list,
                'checkout'=>$checkout,
                'status' => true
            ]);
        }
        return response()->json([
            'status' => false
        ]);
    }
    public function index()
    {

        $shippings=Shipping::orderBy('id','DESC')->get();
        return view('backend.shipping.index',compact('shippings'));
    }

    public function shippingStatus(Request $request){
        if($request->mode=='true'){
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('shippings')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(demoCheck()){
            return redirect()->back();
        }
        $this->validate($request,[
            'shipping_address'=>'string|required',
            'delivery_time'=>'string|required',
            'delivery_charge'=>'numeric|nullable',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=Shipping::create($data);
        if($status){
            $notify[]=['success','Successfully created'];
            return redirect()->route('shipping.index')->withNotify($notify);
        }
        else {
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipping=Shipping::find($id);
        if($shipping){
            return view('backend.shipping.edit',compact('shipping'));
        }
        else{
            $notify[]=['warning','Data not found'];
            return back()->withNotify($notify);
        }
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
        if(demoCheck()){
            return redirect()->back();
        }
        $shipping=Shipping::find($id);
        if($shipping){
            $this->validate($request,[
                'shipping_address'=>'string|required',
                'delivery_time'=>'string|required',
                'delivery_charge'=>'numeric|nullable',
                'status'=>'required|in:active,inactive',
            ]);
            $data=$request->all();
            $status=$shipping->fill($data)->save();
            if($status){
                $notify[]=['success','Successfully updated!'];
                return redirect()->route('shipping.index')->withNotify($notify);
            }
            else {
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }
        }
        else{
            $notify[]=['warning','Data not found'];
            return back()->withNotify($notify);
        }
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
        $shipping=Shipping::find($id);
        if($shipping){
            $status=$shipping->delete();
            if($status){
                $notify[]=['success','Successfully deleted!'];
                return redirect()->route('shipping.index')->withNotify($notify);
            }
            else {
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }
        }
        else{
            $notify[]=['warning','Data not found'];
            return back()->withNotify($notify);
        }
    }

    public function deleteAll(Request $request){
        if(demoCheck()){
            return redirect()->back();
        }
        $ids=$request->ids;

        $shippings=Shipping::whereIn('id',explode(",",$ids))->get();

        $shippings->each(function ($shipping){
            $shipping->delete();
        });

        return response()->json(['msg'=>"Shipping successfully deleted.",'status'=>true]);
    }
}
