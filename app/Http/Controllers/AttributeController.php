<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Color;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function productColors($id=null){
//        $colors=Color::latest()->get();
//        $color=null;
//        if($id){
//            $color=Color::findOrFail($id);
//        }
//        return view('backend.product-attribute.index',compact('colors','color'));
//    }


    public function index()
    {
        $attributes = Attribute::orderBy('created_at', 'desc')->get();
        return view('backend.product-attribute.index', compact('attributes'));
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
        $attribute = new Attribute;
        $attribute->name = $request->name;
        $attribute->save();

        return redirect()->route('attributes.index')->with('success','Attribute has been inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $attribute=Attribute::findOrFail($id);
        $attribute_values=AttributeValue::where('attribute_id',$id)->latest()->get();
        return view('backend.product-attribute.attribute_values',compact('attribute_values','attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('backend.product-attribute.edit', compact('attribute'));

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
        $attribute = Attribute::findOrFail($id);
        $attribute->name = $request->name;
        $attribute->save();

        return redirect()->route('attributes.index')->with('success','Attribute has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Attribute::find($id);
        if($data){
            $status=$data->delete();
            if($status){
                return redirect()->back()->with('success','Attribute successfully deleted');
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
