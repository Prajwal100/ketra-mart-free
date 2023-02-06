<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded=[];

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_ids','cat_ids')->where('status','active')->limit(10);
    }


    public function category(){
        return $this->belongsTo('App\Models\Category','cat_ids','id');
    }

    //subcategory
//    public function subcategory(){
//        return $this->belongsTo('App\Models\Category','child_cat_id','id');
//    }


    // relationship between product & product review
    public function productReviews(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->where('status','accept')->orderBy('id','DESC');
    }

    // Product by subcategory
    public function sub_products(){
        return $this->hasMany('App\Models\Product','child_cat_id','id')->where('status','active')->orderBy('id','DESC');
    }

    // many to many relation with order
    public function orders(){
        return $this->belongsToMany(Order::class,'product_orders')->withPivot('quantity')->withTimestamps();
    }
    public function orderDetails(){
        return $this->hasMany('App\Models\OrderDetail','product_id','id');
    }
    public function reviews(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->where('status','active')->orderBy('id','DESC');
    }


    public function attributes(){
        return $this->hasMany(ProductAttribute::class);
    }

    public function attribute_values(){
        return $this->hasMany(ProductAttributeValue::class);
    }

    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }
    public function variation_combinations(){
        return $this->hasMany(ProductVariationCombination::class);
    }

    public function stocks() {
        return $this->hasMany(ProductStock::class);
    }

}
