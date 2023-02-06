<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_title'=>'KETRA MART Shopping Site',
            'office_time'=>" 9 AM - 6 PM (PDT) . MON-FRI",
            'meta_description'=>"KETRA MART online Shopping ",
            'meta_keywords'=>'Shopping, Fashion dress, ecommerce',
            'favicon'=>'',
            'logo'=>'backend/assets/images/logo.png',
            'email'=>'info@ketramart.com',
            'phone'=>'9818441226',
            'address'=>'Kadaghari, Nepal',
            'facebook_url'=>'https://facebook.com/',
            'instagram_url'=>'https://instagram.com/',
            'twitter_url'=>'https://twitter.com/',
            'youtube_url'=>'https://youtube.com/',
        ]);
    }
}
