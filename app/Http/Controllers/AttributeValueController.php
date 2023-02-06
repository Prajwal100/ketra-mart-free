<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $attribute_value=new AttributeValue;
        $attribute_value->attribute_id=$request->attribute_id;
        $attribute_value->name=str_replace(' ','',$request->name);

        if($request->hasFile('icon')){
            if($file=$request->file('icon')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/attribute/', $imageName);
                $attribute_value->icon='storage/backend/assets/images/attribute/'.$imageName;
            }
            $attribute_value->attribute->update(['has_icon'=>1]);
        }

        if($request->input('color_code') !=null){
            $attribute_value->color_code=$request->color_code;
            $attribute_value->attribute->update(['has_color'=>1]);
        }

        $attribute_value->save();

        return back()->with('success','Attribute value has been added successfully');
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
        $data=AttributeValue::find($id);
        if($data){
            $status=$data->delete();
            if($status){
                return redirect()->back()->with('success','Values successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }
}
