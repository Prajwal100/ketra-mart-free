<?php

/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2021                                  =
==========================================*/

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers=User::orderBy('id','DESC')->get();
        return view('backend.customers.index',compact('customers'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer=User::findOrFail($id);
        if($customer){
            return view('backend.customers.view',compact('customer'));
        }
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(demoCheck()){
            return redirect()->back();
        }
        $customer=User::find($id);
        if($customer){
            return view('backend.customers.edit',compact('customer'));
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
    public function customerControl( $id)
    {
        $customer=User::findOrFail($id);
        if($customer->status=='active'){
            $customer->status='inactive';
            $notify[]=['success','Customer successfully banned'];

        }
        else{
            $customer->status='active';
            $notify[]=['success','Customer successfully unbanned'];
        }
        $customer->save();
        return back()->withNotify($notify);
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
        $user=User::findOrFail($id);
        if($user){
            $status=$user->delete();
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

        $customers=User::whereIn('id',explode(",",$ids))->get();


        $customers->each(function ($customer){
            $customer->delete();
        });

        return response()->json(['msg'=>"Customer successfully deleted.",'status'=>true]);
    }

}
