<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];


    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public static function getTotalEarningPerMonth(){
        $month=Carbon::now()->month;
        $result=self::where('order_status','delivered')->whereMonth('created_at',$month)->sum('total_amount');
        return $result;
    }

    public static function getTotalEarning(){
        $result=self::where('order_status','delivered')->sum('total_amount');
        return $result;
    }


    public static function cart_total($cart){
        $total=0;
        if(!empty($cart)){
            foreach($cart as $item){
                $product_subtotal=$item['price']*$item['quantity'];
                $total +=$product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_grand_total($cart){
        $total=0;
        if(!empty($cart)){
            foreach($cart as $item){
                $product_subtotal=($item['price']*$item['quantity']);
                $total +=$product_subtotal;
            }
        }
        return $total;
    }

    public static function total_shipping_cost($cart){
        $total=0;
        if(!empty($cart)){
            foreach($cart as $item){
                $total +=$item['shipping_cost'];
            }
        }
        return $total;
    }
}
