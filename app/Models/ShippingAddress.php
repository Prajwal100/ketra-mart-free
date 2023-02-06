<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'address',
        'saddress',
        'saddress2',
        'status',
        'country',
        'postcode',
        'state',
        'scountry',
        'address2',
        'spostcode',
        'sstate',
        'saddress',];
}
