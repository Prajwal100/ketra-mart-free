<?php

namespace App\Http\Controllers;

use App\Models\WhyChoose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhyChooseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whychooses=WhyChoose::orderBy('id','DESC')->get();
        return view('backend.why-choose.index',compact('whychooses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.why-choose.create');
    }

    public function whyChooseUsStatus(Request $request){
        if($request->mode=='true'){
            DB::table('why_chooses')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('why_chooses')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
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
            'description'=>'string|nullable',
        ]);
        $data=$request->all();

        $status=WhyChoose::create($data);
        if($status){
            return redirect()->route('why-choose-us.index')->with('success','Successfully created item');
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
        $whychoose=WhyChoose::find($id);
        if($whychoose){
            return view('backend.why-choose.edit',compact('whychoose'));
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
        $whychoose=WhyChoose::find($id);
        if($whychoose){
            $this->validate($request,[
                'description'=>'string|nullable',
            ]);
            $data=$request->all();


            $status=$whychoose->fill($data)->save();
            if($status){
                return redirect()->route('why-choose-us.index')->with('success','Successfully updated item');
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
        $why_choose=WhyChoose::find($id);
        if($why_choose){
            $status=$why_choose->delete();
            if($status){
                return redirect()->route('why-choose-us.index')->with('success','Item successfully deleted');
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
