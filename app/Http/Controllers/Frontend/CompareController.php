<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(){
        return view('frontend.pages.compare');
    }

    public function compareStore(Request $request){
        $product_id=$request->input('product_id');
        $product_qty=$request->input('product_qty');
        $product=Product::getProductByCart($product_id);
        $price=$request->input('product_price');

        $compare_array=[];
        foreach(Cart::instance('compare')->content() as $item){
            $compare_array[]=$item->id;
        }
        if(in_array($product_id,$compare_array)){
            $response['present']=true;
            $response['message']="Item is already in your compare";
        }

        elseif($product[0]['stock']<=0){
            $response['status']=false;
            $response['message']="We don't have enough items";
        }

        elseif(count($compare_array)>3){
            $response['status']=false;
            $response['message']="You can't add more than 4 items";
        }
        else{
            $result=Cart::instance('compare')->add($product_id,$product[0]['title'],$product_qty,$price)->associate('App\Models\Product');
            if($result){
                $response['status']=true;
                $response['message']="Item has been added in compare";
            }
        }



        return json_encode($response);
    }

    public function moveToCart(Request $request){
        $item=Cart::instance('compare')->get($request->input('rowId'));

        Cart::instance('compare')->remove($request->input('rowId'));
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

        if($request->ajax()){
            $compare=view('frontend.layouts._compare-list')->render();
            $response['compare_list']=$compare;
        }
        return $response;
    }

    public function compareDelete(Request $request){
        $id=$request->input('rowId');
        Cart::instance('compare')->remove($id);

        $response['status']=true;
        $response['message']="Item successfully removed from your compare";

        if($request->ajax()){
            $compare_list=view('frontend.layouts._compare-list')->render();
            $response['compare_list']=$compare_list;
        }

        return $response;
    }
}
