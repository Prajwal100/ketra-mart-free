<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use App\Models\ShippingAddress;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Cache;


class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['banner_type'=>'home','status' => 'active'])->orderBy('id', 'DESC')->get();
        $promo_banners = Banner::where(['banner_type'=>'promo','status' => 'active'])->orderBy('id', 'DESC')->first();
        $categories = Category::where(['status' => 'active', 'level' => 0,'parent_id'=>0])->orderBy('position', 'ASC')->get();
        $latest_products = Product::where(['status' => 'active'])->orderBy('id', 'DESC')->limit(8)->get();
        $featured_category = Category::where(['status' => 'active',  'level' => 0,'parent_id'=>0])->with(['products'=>function($query){
            $query->where('status','active');
        }])->where(['featured' => 1])->first();
        $featured_product = Product::where(['status' => 'active', 'is_featured' => 1])->orderBy('id', 'DESC')->get();
        return view('frontend.index', compact([
            'banners',
            'promo_banners',
            'featured_category',
            'latest_products',
            'categories',
            'featured_product',
        ]));
    }


    // Order Status
    public function orderStatus()
    {
        return view('frontend.pages.order-status');
    }
    //order track
    public function orderTrack(Request $request)
    {
        $order = Order::where('order_number', $request->input('order_number'))->first();
        if (isset($order)) {
            $user = User::find($order->user_id);
            if ($order != null && $user->email == $request->input('email')) {

                if ($order->order_status == 'pending') {
                    return redirect()->back()->with('Success', 'Your order has been just placed');
                } elseif ($order->order_status == 'process') {
                    return redirect()->back()->with('Success', 'Your order is on the way');
                } elseif ($order->order_status == 'delivered') {
                    return redirect()->back()->with('Success', 'Your order successfully delivered');
                } elseif ($order->order_status == 'cancelled') {
                    return redirect()->back()->with('Warning', 'Sorry, Your order cancelled! Please try later');
                } else {
                    return \redirect()->back()->with('Error', 'Invalid order Id or Email address');
                }
            } else {
                return \redirect()->back()->with('Error', 'Invalid order Id or Email address');
            }
        } else {
            return \redirect()->back()->with('Error', 'Invalid order Id or Email address');
        }
    }



    //  contact page
    public function contactUs()
    {
        return view('frontend.pages.contact');
    }


}
