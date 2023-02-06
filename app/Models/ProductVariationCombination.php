<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationCombination extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
    public function attribute_value(){
        return $this->belongsTo(AttributeValue::class);
    }
    public function variation(){
        return $this->belongsTo(ProductVariation::class);
    }
}
