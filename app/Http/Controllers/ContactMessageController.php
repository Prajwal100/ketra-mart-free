<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function contactList(){

        $contacts=ContactMessage::orderBy('id','DESC')->get();

        return view('backend.contact.index',compact('contacts'));
    }

    public function contactView(Request $request,$id){
        $contact=ContactMessage::findOrFail($id);
        $status= $contact->update([
            'seen'=>'yes'
        ]);
        return view('backend.contact.view',compact('contact'));

    }

    public function contactDelete(Request $request,$id){
        $contact=ContactMessage::findOrFail($id);
        $status=$contact->delete();
        if($status){
            $notify=['success','Contact message deleted!'];
            return back()->withNotify($notify);
        }
        else{
            $notify=['error','Something went wrong!'];
            return back()->withNotify($notify);
        }
    }
    public function contactMessage(Request $request){
        $this->validate($request,[
            'name'=>'string|required',
            'email'=>'email|required',
            'phone'=>'required',
            'message'=>'required|string|max:200',
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $data=$request->all();
        $status=ContactMessage::create($data);
        if($status){
            $notify[]=['success','Successfully saved your information'];
            return back()->withNotify($notify);
        }
        else{
            $notify[]=['error','Something went wrong!'];
            return back()->withNotify($notify);
        }
    }

    public function deleteAll(Request $request){
        if(demoCheck()){
            return redirect()->back();
        }
        $ids=$request->ids;

        $messages=ContactMessage::whereIn('id',explode(",",$ids))->get();

        $messages->each(function ($message){
            $message->delete();
        });

        return response()->json(['msg'=>"Subscriber successfully deleted.",'status'=>true]);
    }
}
