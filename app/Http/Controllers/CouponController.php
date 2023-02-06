<?php
    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                  =
    ==========================================*/
namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons=Coupon::orderBy('id','DESC')->get();
        return view('backend.coupon.index',compact('coupons'));
    }

    public function couponStatus(Request $request){
        if($request->mode=='true'){
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('coupons')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.coupon.create');
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
            'title'=>'string|nullable',
            'code'=>'bail|required|min:2',
            'start_date'=>'bail|required|date_format:Y-m-d|before_or_equal:expire_date',
            'expire_date'=>'bail|required|date_format:Y-m-d|after_or_equal:start_date',
            'type'=>'bail|required|in:fixed,percent',
            'status'=>'bail|required|in:active,inactive',
            'value'=>'bail|required|numeric'
        ],[
            'code.required'=>'The coupon code field is required'
        ]);
        $data=$request->all();
        if($data['value']>100 && $data['type']=='percent'){
            $notify[]=['error',"You can't give more than 100 percent."];
            return redirect()->back()->withNotify($notify);
        }
        $status=Coupon::create($data);
        if($status){
            $notify[]=['success','Successfully created'];
            return redirect()->route('coupon.index')->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong'];
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
        $coupon=Coupon::find($id);
        if($coupon){
            return view('backend.coupon.edit',compact(['coupon']));
        }
        else{
            return back()->with('error','Coupon not found');
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
        $coupon=Coupon::find($id);
        if($coupon){
            $this->validate($request,[
                'title'=>'string|nullable',
                'code'=>'required|min:2',
                'start_date'=>'required|date_format:Y-m-d|before_or_equal:expire_date',
                'expire_date'=>'required|date_format:Y-m-d|after_or_equal:start_date',
                'type'=>'required|in:fixed,percent',
                'status'=>'required|in:active,inactive',
                'value'=>'required|numeric'
            ],[
                'code.required'=>'The coupon code field is required'
            ]);


            $data=$request->all();
            if($data['value']>100 && $data['type']=='percent'){
                $notify[]=['warning','You can\'t give more than 100 percent.'];
                return back()->withNotify($notify);
            }
            $status=$coupon->fill($data)->save();
            if($status){
                $notify[]=['success','Successfully updated'];
                return redirect()->route('coupon.index')->withNotify($notify);
            }
            else{
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
        $coupon=Coupon::find($id);
        if($coupon){
            $status=$coupon->delete();
            if($status){
                $notify[]=['success','Successfully deleted'];
                return redirect()->back()->withNotify($notify);
            }
            else{
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

        $coupons=Coupon::whereIn('id',explode(",",$ids))->get();


        $coupons->each(function ($coupon){
            $coupon->delete();
        });

        return response()->json(['msg'=>"Coupon successfully deleted.",'status'=>true]);
    }
}
