<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs=FAQ::orderBy('id','DESC')->get();
        return view('backend.faq.index',compact('faqs'));
    }

    public function faqStatus(Request $request){
        if($request->mode=='true'){
            DB::table('f_a_q_s')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('f_a_q_s')->where('id',$request->id)->update(['status'=>'inactive']);
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
        return view('backend.faq.create');

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
            'question'=>'string|required|max:100',
            'answer'=>'string|required',
            'status'=>'required|in:active,inactive',
        ]);
        $data=$request->all();
        $status=FAQ::create($data);
        if($status){
            return redirect()->route('faq.index')->with('success','Successfully created FAQ');
        }
        else{
            return back()->with('error','Something went wrong');
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
        $faq=FAQ::find($id);
        if($faq){
            return view('backend.faq.edit',compact('faq'));
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
        $faq=FAQ::find($id);
        if($faq){
            $this->validate($request,[
                'question'=>'string|required|max:100',
                'answer'=>'string|required',
            ]);
            $data=$request->all();


            $status=$faq->fill($data)->save();
            if($status){
                return redirect()->route('faq.index')->with('success','Successfully updated faq');
            }
            else{
                return back()->with('error','Something went wrong');
            }
        }
        else{
            return back()->with('error','Data not found');
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
        $faq=FAQ::find($id);
        if($faq){
            $status=$faq->delete();
            if($status){
                return redirect()->route('faq.index')->with('success','FAQ successfully deleted');
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
