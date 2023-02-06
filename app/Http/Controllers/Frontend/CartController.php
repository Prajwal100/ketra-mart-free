<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Color;
use App\Models\Coupon;
use App\Models\CustomAttribute;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{

    public function cart(Request $request)
    {
        return view('frontend.pages.cart.index');
    }
//    public function singleCartStore(Request $request)
//    {
//        $product_qty = $request->input('product_quantity');
//        $product_price = $request->input('product_price');
//        $product_id = $request->input('product_id');
//        $product = Product::find($product_id);
//
//        if (empty($product)) {
//            $response['status'] = false;
//            $response['message'] = "Product not product";
//            return $response;
//        }
//
//        if ($request->session()->has('cart')) {
//            if (count($request->session()->get('cart')) > 0) {
//                foreach ($request->session()->get('cart') as $key => $cartItem) {
//                    if ($cartItem['id'] === $request['product_id']) {
//                        $response['message'] = '<i  class="fas fa-exclamation-triangle"></i> Oops: you have already added in shopping cart';
//                        $response['status'] = 'already';
//                        return $response;
//                    }
//                }
//            }
//        }
//
//        $current_item = array(
//            'id' => $product_id,
//            'title' => $product->title,
//            'quantity' => $product_qty,
//            'slug' => $product->slug,
//            'price' => $product->purchase_price,
//            'discount' => $product->discount,
//            'image' => $product->thumbnail_path,
//        );
//
//        dd($current_item);
//
//        $price = $product_price;
//        $cart = session('cart') ? session('cart') : null;
//
//
//        if ($cart) {
//            $cart = $request->session()->get('cart', collect([]));
//            $cart->push($current_item);
//        } else {
//            $cart = collect([$current_item]);
//            $request->session()->put('cart', $cart);
//        }
//        session()->put('cart', $cart);
//
//        $response['data'] = $cart;
//
//
//
//
//        if ($request->ajax()) {
//            $header = view('frontend.layouts.header')->render();
//            $response['header'] = $header;
//            $response['status'] = true;
//            $response['product_url'] = route('product.detail', $product->slug);
//            $response['title'] = ucfirst($product->title);
//            $response['cart_url'] = route('cart');
//        }
//
//        return $response;
//    }

    public function cartAdd(Request $request)
    {

        $product = Product::find($request->id);

        $data = array();
        $data['id'] = $product->id;
        $str = '';
        $variations = [];
        $price = 0;
        $additional_charge = 0;

        //check the color enabled or disabled for the product
        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = AttributeValue::where('color_code', $request['color'])->first()->name;
            $variations['color'] = str_replace(' ', '_', $str);
        }
        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        if (json_decode($product->choice_options)) {
            foreach (json_decode($product->choice_options) as $key => $choice) {
                //                $data[$choice->name] = $request[$choice->name];
                //                $variations[$choice->title] = $request[$choice->name];
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                } else {
                    $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                }
            }
        }


        $data['variation'] = $str;
        if ($str) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price += $product_stock->price;
            $quantity = $product_stock->qty;
        } else {
            $price += $product->purchase_price;
            $quantity = $product->stock;
        }

        if ($request->session()->has('cart')) {
            if (count($request->session()->get('cart')) > 0) {
                foreach ($request->session()->get('cart') as $key => $cartItem) {
                    if ($cartItem['id'] == $request['id'] && $cartItem['variation'] == $str) {
                        $response['message'] = '<i  class="fas fa-exclamation-triangle"></i> Oops: you have already added in shopping cart';
                        $response['status'] = 'already';
                        return $response;
                    }
                }
            }
        }

        $shipping_id = 1;
        $shipping_cost = 0;
        $data['product_id'] = $product->id;
        $data['quantity'] = $request['quantity'];
        $data['slug'] = $product->slug;
        $data['title'] = $product->title;
        $data['discount'] = \Helper::get_product_discount($product, $price);
        $data['image'] = $product->thumbnail_image;
        $data['price'] = $price + ($additional_charge);
        $data['subtotal'] = $data['quantity'] * $data['price'];
        $data['shipping_method_id'] = $shipping_id;
        $data['shipping_cost'] = $shipping_cost;

        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart', collect([]));
            $cart->push($data);
        } else {
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }


        $response['data'] = $cart;




        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $nav = view('frontend.layouts.nav')->render();
            $response['header'] = $header;
            $response['nav'] = $nav;
            $response['status'] = true;
            $response['product_url'] = route('product.detail', $product->slug);
            $response['title'] = ucfirst($product->title);
            $response['cart_url'] = route('cart');
            $response['view'] = view('frontend.partials._added_to_cart', with(['product' => $product, 'data' => $data, 'price' => $data['price'], 'quantity' => $request->quantity]))->render();
        }

        return $response;
    }


    public function cartDelete(Request $request)
    {
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart', collect([]));
            $cart->forget($request->key);
            $request->session()->put('cart', $cart);
        }

        // COUPON UPDATE HERE
        $this->couponAppliedOnUpdatedCart();

        if ($request->ajax()) {
            $header = view('frontend.layouts.header')->render();
            $response['header'] = $header;
            $cart_list = view('frontend.layouts._cart-lists')->render();
            $response['status'] = true;
            $response['message'] = "Cart quantity successfully removed";
            $response['cart_list'] = $cart_list;
        }
        return $response;
    }

    public function cartUpdate(Request $request)
    {
        $cart = $request->session()->get('cart', collect([]));
        $cart = $cart->map(function ($object, $key) use ($request) {
            if ($key == $request->key) {
                $object['quantity'] = $request->quantity;
            }
            return $object;
        });

        $request->session()->put('cart', $cart);

        $this->couponAppliedOnUpdatedCart();
        if ($request->ajax()) {
            $cart_list = view('frontend.layouts._cart-lists')->render();
            $response['status'] = true;
            $response['message'] = "Cart quantity successfully updated";
            $response['cart_list'] = $cart_list;
        }
        return $response;
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;
        $price = 0;

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = str_replace(' ', '_', AttributeValue::where('color_code', $request['color'])->first()->name);
        }

        if (json_decode($product->choice_options) != null) {
            foreach (json_decode($product->choice_options) as $key => $choice) {
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                } else {
                    $str .= str_replace(' ', '',  $request['attribute_id_' . $choice->attribute_id]);
                }
            }
        }

        if ($str) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price += $product_stock->price;
            $quantity = $product_stock->qty;
        } else {
            $price += $product->purchase_price;
            $quantity = $product->stock;
        }

        return array('price' => \Helper::currency_converter($price * $request->quantity), 'quantity' => $quantity);
    }

    //comment add
    public function commentAdd(Request $request)
    {
        if ($request->input('comment') == '') {
            return response()->json(['status' => false, 'message' => "<i class='fas fa-exclamation-triangle'></i> " . " Comment field must be required."]);
        }
        $comment = $request->comment;
        if (count(Coupon::getCart()) <= 0) {
            $response['status'] = false;
            $response['message'] = "<i class='fas fa-exclamation-triangle'></i> " . "Your shopping cart looks like empty!";
            return $response;
        }
        session()->put('comment', $comment);
        $response['status'] = true;
        $response['message'] = "<i class='fas fa-check-circle'></i> " . "Your comment successfully saved.";
        return $response;
    }

    //    Coupon

    public function couponAdd(Request $request)
    {

        $code = $request->code;
        if ($request->input('code') == '') {
            return response()->json(['status' => false, 'message' => "<i class='fas fa-exclamation-triangle'></i> " . " Coupon code must be required."]);
        }

        $date = Carbon::now()->format('Y-m-d');
        $coupon = Coupon::where('code', $code)->first();

        $total = 0;
        if (count(Coupon::getCart()) <= 0) {
            $response['status'] = false;
            $response['message'] = "<i class='fas fa-exclamation-triangle'></i> " . "Your shopping cart looks like empty!";
            return $response;
        }
        foreach (Coupon::getCart() as $cart) {
            $product_subtotal = $cart['price'] * $cart['quantity'];
            $total += $product_subtotal;
        }

        if ($coupon) {
            $is_valid = $coupon->where('start_date', '<=', $date)->where('expire_date', '>', $date)->exists();
            if ($is_valid) {
                if ($coupon['type'] == 'percent') {
                    $discount = ($total / 100) * $coupon['value'];
                } else {
                    $discount = $coupon['value'];
                }

                if (session()->has('coupon_code') && session()->get('coupon_code') == $code) {
                    $response['status'] = false;
                    $response['message'] = "<i class='fas fa-times-circle'></i> " . "You already applied that coupon code.";
                    return $response;
                } else {
                    session()->put('coupon_code', $code);
                    session()->put('coupon_discount', $discount);

                    $cart_list = view('frontend.layouts._cart-lists')->render();
                    $response['cart_list'] = $cart_list;
                    $response['status'] = true;
                    $response['message'] = "<i class='fas fa-check-circle'></i> " . "Your coupon code successfully applied.";
                    return $response;
                }
            } else {
                $response['status'] = false;
                $response['message'] = "<i class='fas fa-exclamation-triangle'></i> " . "Your coupon code expired!";
                return $response;
            }
        }

        $response['status'] = false;
        $response['message'] = "<i class='fas fa-times-circle'></i> " . "Invalid coupon code!";
        return $response;
    }


    private function couponAppliedOnUpdatedCart(){
        $coupon_code=session()->has('coupon_code') ? session()->get('coupon_code') : '';

        $total = 0;
        if (count(Coupon::getCart()) <= 0) {
            $response['status'] = false;
            $response['message'] = "<i class='fas fa-exclamation-triangle'></i> " . "Your shopping cart looks like empty!";
            return $response;
        }
        foreach (Coupon::getCart() as $cart) {
            $product_subtotal = $cart['price'] * $cart['quantity'];
            $total += $product_subtotal;
        }


        if($coupon_code){
            $coupon = Coupon::where('code', $coupon_code)->first();
            if ($coupon['type'] == 'percent') {
                $discount = ($total / 100) * $coupon['value'];
            } else {
                $discount = $coupon['value'];
            }

            session()->put('coupon_discount', $discount);

            $cart_list = view('frontend.layouts._cart-lists')->render();
            $response['cart_list'] = $cart_list;
            $response['status'] = true;
            $response['message'] = "<i class='fas fa-check-circle'></i> " . "Your coupon code successfully applied.";
            return $response;
        }
        else{
            $response['message'] = "<i class='fas fa-exclamation-triangle'></i> " . "Coupon doesn't exists!";
            return $response;
        }

    }
}
