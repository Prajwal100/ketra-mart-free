<?php

/*==========================================
=   Author: Prajwal Rai                                 =
=   Author URI: https://raiprajwal.com                  =
=   Author GITHUB URI: https://github.com/prajwal100    =
=   Copyright (c) 2021                                  =
==========================================*/

namespace App\Http\Controllers;

use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Role::orderBy('id','DESC')->get();
        return view('backend.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        $role=new Role;
        $role->name=$request->name;
        $role->permissions=json_encode($request->permissions);

        $status=$role->save();
        if($status){
            return redirect()->route('roles.index')->with('success','Successfully created');
        }
        else{
            return redirect()->back()->with('error','Something went wrong');
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
        $role=Role::find($id);
        if($role){
            return view('backend.role.edit',compact('role'));
        }
        else{
            return back()->with('error','Data not found');
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
        $role=Role::findOrFail($id);

        $this->validate($request,[
            'name'=>'required',
        ]);
        $role->name=$request->name;
        $role->permissions=json_encode($request->permissions);

        $status=$role->save();
        if($status){
            return redirect()->route('roles.index')->with('success','Successfully updated');
        }
        else{
            return redirect()->back()->with('error','Something went wrong!');
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
        $role=Role::findOrFail($id);
        if($role){
            $status=$role->delete();
            if($status){
                return redirect()->back()->with('success','Successfully deleted');
            }
            else{
                return redirect()->back()->with('error','Something went wrong!');
            }
        }
        abort(404);
    }
}
