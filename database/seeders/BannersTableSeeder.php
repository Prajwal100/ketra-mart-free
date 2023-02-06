<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            [
                'banner_type'=>'home',
                'image'=>'frontend/assets/images/banners/01.png',
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'banner_type'=>'home',
                'image'=>'frontend/assets/images/banners/02.jpg',
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'banner_type'=>'promo',
                'image'=>'frontend/assets/images/banners/promo-banner1.jpg',
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'banner_type'=>'promo',
                'image'=>'frontend/assets/images/banners/promo-banner2.jpg',
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ]);
    }
}
