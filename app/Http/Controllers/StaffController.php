<?php

/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2023                                  =
==========================================*/

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use App\Models\Staff;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff=Staff::whereHas('admin',function($query){
            $query->where('is_admin',0);
        })->orderBy('id','DESC')->get();
        return view('backend.staff.index',compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('backend.staff.create',compact('roles'));
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
            return back();
        }
        $this->validate($request,[
            'name'=>'required',
        ]);

        if(Admin::where('email',$request->email)->first() ==null){
            $admin=new Admin;
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->status=$request->status;
            $admin->is_admin=0;
            $admin->password=Hash::make($request->password);
            if($admin->save()){
                $staff=new Staff;
                $staff->admin_id=$admin->id;
                $staff->role_id=$request->role_id;
                if($staff->save()){
                    $notify[]=['success','Successfully created'];
                    return redirect()->route('staff.index')->withNotify($notify);
                }
                else{
                    $notify[]=['error','Something went wrong!'];
                    return redirect()->back()->withNotify($notify);
                }
            }
        }
        else{
            $notify[]=['warning','Email already used'];
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
        $staff=Staff::find($id);
        $roles=Role::all();
        if($staff){
            return view('backend.staff.edit',compact('staff','roles'));
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
            return back();
        }
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email'
        ]);
        $staff=Staff::findOrFail($id);
        $admin=$staff->admin;
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->status=$request->status;
        $admin->is_admin=0;
        if(strlen($request->password) > 0){
            $admin->password = Hash::make($request->password);
        }
        if($admin->save()){
            $staff->role_id=$request->role_id;
            if($staff->save()){
                $notify[]=['success','Successfully created'];
                return redirect()->route('staff.index')->withNotify($notify);
            }
            else{
                $notify[]=['error','Something went wrong!'];
                return redirect()->back()->withNotify($notify);
            }
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
        if(demoCheck()){
            return redirect()->back();
        }
        $staff=Staff::findOrFail($id);
        if($staff){
            $status=$staff->delete();
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
}
