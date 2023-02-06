<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            //Parent Categories
            [
                'title'=>'Wedding Dress',
                'slug'=>'wedding-dress',
                'banner'=>null,
                'icon'=>'frontend/assets/images/icons/wedding-dress.svg',
                'level'=>0,
                'position'=>1,
                'featured'=>1,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Bridesmaid Dresses',
                'slug'=>'bridesmaid-dresses',
                'banner'=>null,
                'icon'=>'frontend/assets/images/icons/bridesmaid.svg',

                'level'=>0,
                'position'=>2,
                'featured'=>1,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Wedding Party',
                'slug'=>'wedding-party',
                'banner'=>null,
                'icon'=>'frontend/assets/images/icons/wedding.svg',
                'level'=>0,
                'position'=>3,
                'featured'=>1,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Prom Dresses',
                'slug'=>'prom-dresses',
                'banner'=>null,
                'icon'=>'frontend/assets/images/icons/prom-night.svg',
                'level'=>0,
                'position'=>4,
                'featured'=>1,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Special Occasions',
                'slug'=>'special-occasions',
                'banner'=>null,
                'icon'=>'frontend/assets/images/icons/special.svg',
                'level'=>0,
                'position'=>5,
                'featured'=>0,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Accessories',
                'slug'=>'accessories',
                'icon'=>'frontend/assets/images/icons/accessories.svg',
                'banner'=>null,
                'level'=>0,
                'position'=>6,
                'featured'=>0,
                'parent_id'=>0,
                'is_menu'=>1,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            // Level 1 (subcategories)
            [
                'title'=>'Wedding Guest Dresses',
                'slug'=>'wedding-guest-dresses',
                'banner'=>null,
                'icon'=>null,
                'level'=>1,
                'position'=>null,
                'featured'=>0,
                'parent_id'=>3,
                'is_menu'=>0,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'title'=>'Flower Girls Dresses',
                'slug'=>'flower-girls-dresses',
                'banner'=>null,
                'icon'=>null,
                'level'=>1,
                'position'=>0,
                'featured'=>0,
                'parent_id'=>3,
                'is_menu'=>0,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'title'=>'Men Accessories',
                'slug'=>'men-accessories',
                'banner'=>null,
                'icon'=>null,
                'level'=>1,
                'position'=>0,
                'featured'=>0,
                'parent_id'=>6,
                'is_menu'=>0,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'title'=>'Headpieces',
                'slug'=>'headpieces',
                'banner'=>null,
                'icon'=>null,
                'level'=>1,
                'position'=>0,
                'featured'=>0,
                'parent_id'=>2,
                'is_menu'=>0,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'title'=>'Luxury Collection',
                'slug'=>'luxury-collection',
                'banner'=>null,
                'icon'=>null,
                'level'=>1,
                'position'=>0,
                'featured'=>0,
                'parent_id'=>2,
                'is_menu'=>0,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

        ]);
    }
}
