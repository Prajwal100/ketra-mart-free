<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable=['title','code','type','value','status','start_date','expire_date'];

    public static function getCart(){
        if(session()->has('cart')){
            $x=session('cart');
        }
        else{
            $x=[];
        }
        return $x;
    }
}
