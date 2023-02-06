<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Env\Response;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist(){
        return view('frontend.pages.wishlist');
    }

    public function wishlistStore(Request $request){

        if($request->ajax()){
            if(auth()->check()){
                $product_id=$request->input('product_id');
                $user_id=auth()->user()->id;

                $already_in_wishlist=Wishlist::where(['product_id'=>$product_id,'user_id'=>$user_id])->count();

                if($already_in_wishlist>=1){
                    $msg='Item is already in your wishlist';
                    return response()->json(['msg'=>$msg,'status'=>'present','data'=>null]);
                }
                else{
                    $wishlist=new Wishlist();
                    $wishlist->user_id=$user_id;
                    $wishlist->product_id=$product_id;
                    $status=$wishlist->save();
                    if($status){
                        $msg='Item has been saved in wishlist';

                        session()->put('wishlist', Wishlist::where('user_id', $user_id)->pluck('product_id')->toArray());
                        return response()->json(['msg'=>$msg,'status'=>true,'data'=>null]);
                    }
                    else{
                        $msg='Something went wrong';
                        return response()->json(['msg'=>$msg,'status'=>false,'data'=>null]);
                    }
                }
            }
            else{
                $msg='Please login first';
                return response()->json(['msg'=>$msg,'status'=>false,'data'=>null]);
            }
        }
    }

    public function moveToCart(Request $request){
        $item=Cart::instance('wishlist')->get($request->input('rowId'));

        Cart::instance('wishlist')->remove($request->input('rowId'));
        $result=Cart::instance('shopping')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');

        if($result){
            $response['status']=true;
            $response['message']="Item has been moved to a cart";
            $response['cart_count']=Cart::instance('shopping')->count();
        }
        if($request->ajax()){
            $wishlist=view('frontend.layouts._wishlist')->render();
            $header=view('frontend.layouts.header')->render();
            $response['wishlist_list']=$wishlist;
            $response['header']=$header;
        }
        return $response;
    }

    public function wishlistDelete(Request $request){
        if($request->ajax()){
            $product_id=$request->input('id');
            $user_id=auth()->user()->id;
            $status=Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->delete();
            $wishlist=view('frontend.layouts._wishlist')->render();
            if($status){
                $msg='Item successfully removed from your wishlist';
                return response()->json([
                    'msg'=>$msg,'status'=>true,
                    'wishlist_html'=>$wishlist
                ]);
            }
            else{
                return response()->json([
                    'msg'=>'Something went wrong',
                ]);
            }
        }
    }
}
