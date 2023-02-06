<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagerController extends Controller
{
    public function userDashboard()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)->orderBy('id', 'DESC')->limit(10)->get();

        return view('frontend.user.dashboard', compact('user', 'orders'));
    }
    public function userOrder()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();
        return view('frontend.user.order', compact('user', 'orders'));
    }

    public function orderCancelUser($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'cancelled';
        $status = $order->save();
        if ($status) {
            return back()->with('success', 'Your order cancelled');
        } else {
            return back()->with('error', 'Please try again');
        }
    }
    public function userAddress()
    {
        $user = Auth::user();

        return view('frontend.user.address', compact('user'));
    }
    public function userAccount()
    {
        $user = Auth::user();

        return view('frontend.user.account', compact('user'));
    }

    public function billingAddress(Request $request, $id)
    {
        $this->validate($request, [
            'country' => 'string|nullable',
            'address' => 'string|required',
            'address2' => 'string|nullable',
            'state' => 'string|nullable',
            'postcode' => 'numeric|nullable',
            'country' => 'string|nullable',
        ]);

        $shipping = ShippingAddress::where('user_id', $id)->first();
        if ($shipping) {
            $user = ShippingAddress::where('user_id', $id)->update(['country' => $request->country, 'address2' => $request->address2, 'postcode' => $request->postcode, 'address' => $request->address, 'state' => $request->state]);
        } else {
            $user = ShippingAddress::create(['user_id' => $id, 'country' => $request->country, 'address2' => $request->address2, 'postcode' => $request->postcode, 'address' => $request->address, 'state' => $request->state]);
        }

        if ($user) {
            return back()->with('success', 'Billing address successfully updated!');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    public function shippingAddress(Request $request, $id)
    {
        $this->validate($request, [
            'scountry' => 'string|nullable',
            'saddress' => 'string|required',
            'saddress2' => 'string|nullable',
            'sstate' => 'string|nullable',
            'spostcode' => 'numeric|nullable',
        ]);


        $shipping = ShippingAddress::where('user_id', $id)->first();
        if ($shipping) {
            $user = ShippingAddress::where('user_id', $id)->update(['user_id' => $id, 'scountry' => $request->scountry, 'saddress2' => $request->saddress2, 'spostcode' => $request->spostcode, 'saddress' => $request->saddress, 'sstate' => $request->sstate]);
        } else {
            $user = ShippingAddress::where('user_id', $id)->create(['user_id' => $id, 'scountry' => $request->scountry, 'saddress2' => $request->saddress2, 'spostcode' => $request->spostcode, 'saddress' => $request->saddress, 'sstate' => $request->sstate]);
        }
        if ($user) {
            return back()->with('success', 'Shipping address successfully updated!');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'newpassword' => 'nullable|min:6',
            'oldpassword' => 'nullable',
            'full_name' => 'required|string',
            'username' => 'nullable|string',
            'phone' => 'nullable|min:8',
        ]);
        $hashpassword = Auth::user()->password;

        if ($request->oldpassword == null && $request->newpassword != null) {
            User::where('id', $id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone, 'password' => Hash::make($request->input('newpassword'))]);
            return back()->with('success', 'Account successfully updated');
        }

        if ($request->oldpassword == null && $request->newpassowrd == null) {
            User::where('id', $id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone]);
            return back()->with('success', 'Account successfully updated');
        } else {
            if (\Hash::check($request->oldpassword, $hashpassword)) {
                if (!\Hash::check($request->newpassword, $hashpassword)) {
                    User::where('id', $id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone, 'password' => Hash::make($request->newpassword)]);
                    return back()->with('success', 'Account successfully updated');
                } else {
                    return back()->with('info', 'New password can not be same with old password');
                }
            } else {
                return back()->with('error', 'Old password does not match');
            }
        }
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
        ]);

        $data = $request->all();

        $subscribe = new Subscribe();

        $count = Subscribe::where('email', $request->email)->count();

        if ($count) {
            return response()->json(['status' => false, 'msg' => "You already subscribed with this email"]);
        }

        $status = $subscribe->create($data);

        if ($status) {
            return response()->json(['status' => true, 'msg' => "Successfully subscribed with this email"]);
        } else {
            return response()->json(['status' => false, 'msg' => "Sorry, Something went wrong, Please try again"]);
        }
    }
}
