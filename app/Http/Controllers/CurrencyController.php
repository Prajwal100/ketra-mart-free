<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //frontend
    public function currencyChange(Request $request){
        session()->put('currency_code', $request->currency_code);
        $currency = Currency::where('code', $request->currency_code)->first();
        session()->put('currency_symbol', $currency->symbol);
        session()->put('currency_exchange_rate', $currency->exchange_rate);
        session()->put('flag_path', $currency->flag_path);

        $response['message']='<i class="fas fa-check-circle"></i> '.'Success: Currency successfully set to '."<strong>$request->currency_code</strong>";
        $response['status']=true;
        $response['data']=$currency;
        return $response;
    }


    public function index()
    {
        $currencies=Currency::orderBy('id','DESC')->get();
        return view('backend.currency.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function currencyStatus(Request $request){
        if($request->mode=='true'){
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'active']);
        }
        else{
            DB::table('currencies')->where('id',$request->id)->update(['status'=>'inactive']);
        }
        return response()->json(['msg'=>'Successfully updated status','status'=>true]);
    }
    public function create()
    {
        return view('backend.currency.create');
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
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $this->validate($request,[
            'name'=>'string|required',
            'symbol'=>'string|required|unique:currencies,symbol',
            'exchange_rate'=>'required',
            'code'=>'required|string|unique:currencies,code|max:5',
            'status'=>'required|in:active,inactive',
            'flag'=>'image|nullable|mimes:png,jpg,jpeg,svg,gif',
        ]);
        $data=$request->all();
        if($request->hasFile('flag')){
            if($file=$request->file('flag')){
                $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                $file->storeAs('public/backend/assets/images/currency/', $imageName);
                $data['flag']=$imageName;
                $data['flag_path']='storage/backend/assets/images/currency/'.$imageName;
            }
        }

        $status=Currency::create($data);
        if($status){
            return redirect()->route('currency.index')->with('success','Currency successfully created');
        }
        else{
            return back()->with('error','Something went wrong!');
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
        $currency=Currency::find($id);
        if($currency){
            return view('backend.currency.edit',compact(['currency']));
        }
        else{
            return back()->with('error','Currency not found');
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
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $currency=Currency::find($id);
        if($currency){
            $this->validate($request,[
                'name'=>'string|required',
                'symbol'=>"required|string|unique:currencies,symbol,".$id,
                'exchange_rate'=>'required',
                'code'=>"required|string|max:5|unique:currencies,code,".$id,
                'status'=>'nullable|in:active,inactive',
                'flag'=>'image|nullable|mimes:png,jpg,jpeg,svg,gif',

            ]);

            $data=$request->all();

            if($request->hasFile('flag')){
                if($file=$request->file('flag')){
                    $imageName = time() ."-". str_replace(' ', '-', $file->getClientOriginalName());
                    $file->storeAs('public/backend/assets/images/currency/', $imageName);
                    $data['flag']=$imageName;
                    $data['flag_path']='storage/backend/assets/images/currency/'.$imageName;
                }
            }


            $status=$currency->fill($data)->save();
            if($status){
                return redirect()->route('currency.index')->with('success','Currency successfully updated');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Currency not found');
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
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $currency=Currency::find($id);
        if($currency){
            $status=$currency->delete();
            if($status){
                return redirect()->route('currency.index')->with('success','Currency successfully deleted');
            }
            else{
                return back()->with('error','Something went wrong!');
            }
        }
        else{
            return back()->with('error','Data not found');
        }
    }
}
