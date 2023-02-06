<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetMail;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

//    public function sendResetLinkEmail(Request $request){
//        if(filter_var($request->email,FILTER_VALIDATE_EMAIL)){
//            $user=User::where('email',$request->email)->first();
//            if($user !=null){
//                $user->verification_code=rand(100000,999999);
//                $user->save();
//
//                $array['view']='emails.verification';
//                $array['from']=env('MAIL_USERNAME');
//                $array['subject']="Password Reset";
//                $array['content']="Verification Code is ".$user->verification_code;
//                Mail::to($user->email)->send(new ResetMail($array));
//                return back()->with('success','successfully sent you verification code. Please check');
//            }
//            else{
//                return back()->with('error','No account exists with this email');
//            }
//        }
//    }
}
