<?php

    /*==========================================
    =   Author: Prajwal Rai                                 =
    =   Author URI: https://raiprajwal.com                  =
    =   Author GITHUB URI: https://github.com/prajwal100    =
    =   Copyright (c) 2023                                  =
    ==========================================*/

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    //Mail setting
    public function smtpSetting(){
        return view('backend.settings.smtp_setting');
    }

    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        $notify[]=['success','Setting updated successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace(
                    $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                ));
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }

    public function socialLogin(){
        return view('backend.settings.social-login');
    }

    public function paymentMethod(){
        return view('backend.settings.payment-method');
    }

    public function paymentMethodUpdate(Request $request){
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }

        $setting=Setting::first();

        if($setting->paypal_sandbox !==null){
            if($request->has('paypal_sandbox')){
                $setting->paypal_sandbox=1;
                $setting->save();

            }
            else{
                $setting->paypal_sandbox=0;
                $setting->save();

            }
        }
        $notify[]=['success','Setting updated successfully'];
        return redirect()->back()->withNotify($notify);

    }

    public function settings(){
        $settings=Setting::first();
        return view('backend.settings.index',compact('settings'));
    }

    public function settingsUpdate(Request $request){
        if(demoCheck()){
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $setting=Setting::first();
        $this->validate($request,[
            'site_title'=>'bail|string|required',
            'logo'=>'bail|image|nullable|mimes:png,jpg,svg,gif,jpeg',
            'favicon'=>'bail|image|nullable|mimes:png,jpg,svg,gif,jpeg',
            'email'=>'bail|email|required',
            'phone'=>'bail|required',
            'address'=>'bail|string|required',
        ]);

        $data=$request->all();
        //logo
        if($request->hasFile('logo')){
            if($file=$request->file('logo')){

                if($setting->logo !=null && file_exists(public_path() . '/' . $setting->logo)){
                    unlink(public_path() . '/'. $setting->logo);
                }

                $fileName=\ImageUploadingHelper::UploadImage('backend/assets/img/settings/',$file,$request->input('site_title'),300,300);

                $data['logo']=$fileName;
            }
        }

        //favicon
        if($request->hasFile('favicon')){
            if($file=$request->file('favicon')){

                if($setting->favicon !=null && file_exists(public_path() . '/' . $setting->favicon)){
                    unlink(public_path() . '/'. $setting->favicon);
                }

                $fileName=\ImageUploadingHelper::UploadImage('backend/assets/img/settings/',$file,$request->input('site_title'),300,300);

                $data['favicon']=$fileName;
            }
        }


        $status=$setting->update($data);
        if($status){
            $notify[]=['success','Successfully updated'];
            return redirect()->back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
        }
     }

     public function aboutUs(){
         $setting=Setting::first();
         $aboutUs=json_decode($setting->about_us);
         return view('backend.settings.about-us',compact('aboutUs'));
     }

     public function aboutUsUpdate(Request $request){
         if(demoCheck()){
             return redirect()->back()->with('error','For the demo version, you cannot change this');
         }
         $setting=Setting::first();
         $aboutUs=json_decode($setting->about_us);

         $this->validate($request,[
            'description1'=>'string|nullable',
            'description2'=>'string|nullable',
            'image1'=>'image|nullable|mimes:png,jpg,jpeg,svg,gif',
            'image2'=>'image|nullable|mimes:png,jpg,jpeg,svg,gif',
        ]);
        $data=$request->all();

        $data['image1']=$aboutUs->image1 ?? null;
        $data['image1_path']=$aboutUs->image1_path ?? null;
        $data['image2']=$aboutUs->image2 ?? null;
        $data['image2_path']=$aboutUs->image2_path ?? null;


         if($request->hasFile('image1')){
             if($file=$request->file('image1')){
                 $imageName=time().'-'.$file->getClientOriginalName();
                 $file->storeAs('public/frontend/images/settings/',$imageName);
                 $data['image1']=$imageName;
                 $data['image1_path']='storage/frontend/images/settings/'.$imageName;
             }
         }

         if($request->hasFile('image2')){
             if($file=$request->file('image2')){
                 $imageName=time().'-'.$file->getClientOriginalName();
                 $file->storeAs('public/frontend/images/settings/',$imageName);
                 $data['image2']=$imageName;
                 $data['image2_path']='storage/frontend/images/settings/'.$imageName;
             }
         }

        $status=$setting->update([
            'about_us'=>json_encode([
                'description1'=>$request->description1,
                'description2'=>$request->description2,
                'image1'=>$data['image1'],
                'image1_path'=>$data['image1_path'],
                'image2'=>$data['image2'],
                'image2_path'=>$data['image2_path'],
            ])
        ]);

         if($status){
             $notify[]=['success','Successfully updated'];
             return redirect()->back()->withNotify($notify);
         }
         else{
             $notify[]=['error','Something went wrong!'];
             return redirect()->back()->withNotify($notify);
         }
     }

     public function returnPolicy(){
         $setting=Setting::first();
         return view('backend.settings.return_policy',compact('setting'));
     }

     public function returnPolicyUpdate(Request $request){

         if(demoCheck()){
             return redirect()->back()->with('error','For the demo version, you cannot change this');
         }
        $status=Setting::first()->update([
            'return_policy'=>$request->return_policy
        ]);
         if($status){
             $notify[]=['success','Successfully updated'];
             return redirect()->back()->withNotify($notify);
         }
         else{
             $notify[]=['error','Something went wrong!'];
             return redirect()->back()->withNotify($notify);
         }
     }

    public function privacyPolicy(){
        $setting=Setting::first();
        return view('backend.settings.privacy_policy',compact('setting'));
    }

    public function privacyPolicyUpdate(Request $request){
        if(demoCheck()){
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $status=Setting::first()->update([
            'privacy_policy'=>$request->privacy_policy
        ]);
        if($status){
            $notify[]=['success','Successfully updated'];
            return redirect()->back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function shippingPayment(){
        $setting=Setting::first();
        return view('backend.settings.shipping_payment',compact('setting'));
    }

    public function shippingPaymentUpdate(Request $request){
        if(demoCheck()){
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $status=Setting::first()->update([
            'shipping_payment'=>$request->shipping_payment
        ]);
        if($status){
            $notify[]=['success','Successfully updated'];
            return redirect()->back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function termsConditions(){
        $setting=Setting::first();
        return view('backend.settings.terms_conditions',compact('setting'));
    }

    public function termsConditionsUpdate(Request $request){
        if(demoCheck()){
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $status=Setting::first()->update([
            'terms_conditions'=>$request->terms_conditions
        ]);
        if($status){
            $notify[]=['success','Successfully updated'];
            return redirect()->back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function cancellationPolicy(){
        if(demoCheck()){
            return redirect()->back()->with('error','For the demo version, you cannot change this');
        }
        $setting=Setting::first();
        return view('backend.settings.cancellation_policy',compact('setting'));
    }

    public function cancellationPolicyUpdate(Request $request){
        $status=Setting::first()->update([
            'cancellation_policy'=>$request->cancellation_policy
        ]);
        if($status){
            $notify[]=['success','Successfully updated'];
            return redirect()->back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return redirect()->back()->withNotify($notify);
        }
    }

}
