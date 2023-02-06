<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }

    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id');
    }

    public function products(){
        return $this->hasMany('App\Models\Product','cat_ids','id')->where('status','active');
    }

    public function subcategories(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active')->limit(8);
    }

    public function getAllParentWithChild(){
        return Category::with('subcategories')->where(['status'=>'active','is_parent'=>1])->orderBy('id','DESC')->limit(3)->get();
    }


}


