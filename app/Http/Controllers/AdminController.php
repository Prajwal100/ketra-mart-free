<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Subscribe;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Admin dashboard
    public function dashboard(){
        $data=[];

        $total_earning_per_month=Order::getTotalEarningPerMonth();
        $data['total_earning_per_month']=$this->roundUpEarning($total_earning_per_month);

        $total_earning=Order::getTotalEarning();
        $data['total_earning']=$this->roundUpEarning($total_earning);


        //monthly registered users
        $monthlyUsers = array(
            User::whereMonth('created_at', '01')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //January
            User::whereMonth('created_at', '02')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //Feb
            User::whereMonth('created_at', '03')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //March
            User::whereMonth('created_at', '04')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //April
            User::whereMonth('created_at', '05')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //May
            User::whereMonth('created_at', '06')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //June
            User::whereMonth('created_at', '07')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //July
            User::whereMonth('created_at', '08')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //August
            User::whereMonth('created_at', '09')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //September
            User::whereMonth('created_at', '10')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //October
            User::whereMonth('created_at', '11')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //November
            User::whereMonth('created_at', '12')->where('status', 'active')
                ->whereYear('created_at', date('Y'))
                ->count(), //December
        );

        //recently registered users
        $recently_users=User::where('status','active')->latest()->limit(5)->get();

        return view('backend.dashboard',compact('data','monthlyUsers'));
    }

    private function roundUpEarning(int $amount){
        if ($amount > 1000000000000) {
            $data = round($amount / 1000000000000, 1) . 'T';
        } elseif ($amount > 1000000000) {
             $data = round($amount / 1000000000, 1) . 'B';
        } elseif ($amount > 1000000) {
             $data = round($amount / 1000000, 1) . 'M';
        } elseif ($amount > 1000) {
             $data = round($amount / 1000, 1) . 'K';
        } else {
             $data = round($amount);
        }

        return $data;
    }



    public function subscribes(){
        $subscribes=Subscribe::orderBy('id','DESC')->get();
        return view('backend.subscribes',compact('subscribes'));
    }

    public function subscribeDelete($id){
        $subscribe=Subscribe::find($id);

        if($subscribe){
            $status=$subscribe->delete();
            if($status){
                $notify[] = ['success', 'Successfully deleted!'];
                return back()->withNotify($notify);
            }
            else{
                $notify[] = ['error', 'Something went wrong!'];
                return back()->withNotify($notify);
            }
        }

    }


    public function deleteAll(Request $request){
        if(demoCheck()){
            return redirect()->back();
        }
        $ids=$request->ids;

        $subscribers=Subscribe::whereIn('id',explode(",",$ids))->get();

        $subscribers->each(function ($subscriber){
            $subscriber->delete();
        });

        return response()->json(['msg'=>"Subscriber successfully deleted.",'status'=>true]);
    }
}
