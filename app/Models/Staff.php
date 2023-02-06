<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable=['admin_id','role_id'];

    public function admin(){
        return $this->hasOne('App\Models\Admin','id','admin_id');
    }

    public function role(){
        return $this->hasOne(Role::class,'id','role_id');
    }
}
