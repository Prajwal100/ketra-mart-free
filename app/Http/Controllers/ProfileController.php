<?php

/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2023                                  =
==========================================*/

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.profile.index');
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
        $admin=Admin::findOrFail($id);
        return view('backend.profile.edit',compact('admin'));
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

        $this->validate($request,[
            'new_password'=>'nullable|min:6',
            'confirm_password'=>'nullable|min:6',
        ]);

        $admin=Admin::findOrFail($id);

        $admin->name=$request->name;
        $admin->email=$request->email;

        if($request->new_password !=null && $request->confirm_password !=null){
            if($request->new_password != $request->confirm_password){
                $notify[]=['error','Password does\'t match! please try again'];
                return redirect()->back()->withNotify($notify);
            }
            if(($request->new_password== $request->confirm_password)){
                $admin->password=Hash::make($request->new_password);
            }
        }


        $status=$admin->save();
        if($status){
            $notify[]=['success','Your Profile has been updated successfully!'];
            return redirect()->route('profile.index')->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
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
        //
    }
}
