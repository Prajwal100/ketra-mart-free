<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    use HasFactory;
    protected $fillable=['title','position','status'];

    public function products(){
        return $this->hasMany(Product::class,'display_id','id');
    }
}
