<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{
    use HasFactory;

    protected $fillable=['order_id','user_id','product_id','song_name','album_name','image','image_path','color'];
}
