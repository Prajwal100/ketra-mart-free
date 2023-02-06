<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable=['name','product_id','rate','review','status'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
