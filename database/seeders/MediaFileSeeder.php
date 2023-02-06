<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //general
        DB::table('media_files')->insert([
            ['file_name' => 'avatar', 'file_path' => 'demo/general/avatar.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'avatar-2', 'file_path' => 'demo/general/avatar-2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'avatar-3', 'file_path' => 'demo/general/avatar-3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'ico_adventurous', 'file_path' => 'demo/general/ico_adventurous.png', 'file_type' => 'image/png', 'file_extension' => 'png'],
            ['file_name' => 'ico_localguide', 'file_path' => 'demo/general/ico_localguide.png', 'file_type' => 'image/png', 'file_extension' => 'png'],
            ['file_name' => 'ico_maps', 'file_path' => 'demo/general/ico_maps.png', 'file_type' => 'image/png', 'file_extension' => 'png'],
            ['file_name' => 'ico_paymethod', 'file_path' => 'demo/general/ico_paymethod.png', 'file_type' => 'image/png', 'file_extension' => 'png'],
            ['file_name' => 'logo', 'file_path' => 'demo/general/logo.svg', 'file_type' => 'image/svg+xml', 'file_extension' => 'svg'],
            ['file_name' => 'bg_contact', 'file_path' => 'demo/general/bg-contact.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'favicon', 'file_path' => 'demo/general/favicon.png', 'file_type' => 'image/png', 'file_extension' => 'png'],
            ['file_name' => 'thumb-vendor-register', 'file_path' => 'demo/general/thumb-vendor-register.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'bg-video-vendor-register1', 'file_path' => 'demo/general/bg-video-vendor-register1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'ico_chat_1', 'file_path' => 'demo/general/ico_chat_1.svg', 'file_type' => 'image/svg', 'file_extension' => 'svg'],
            ['file_name' => 'ico_friendship_1', 'file_path' => 'demo/general/ico_friendship_1.svg', 'file_type' => 'image/svg', 'file_extension' => 'svg'],
            ['file_name' => 'ico_piggy-bank_1', 'file_path' => 'demo/general/ico_piggy-bank_1.svg', 'file_type' => 'image/svg', 'file_extension' => 'svg'],
            ['file_name' => 'home-mix', 'file_path' => 'demo/general/home-mix.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'image_home_mix_1', 'file_path' => 'demo/general/image_home_mix_1.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'image_home_mix_2', 'file_path' => 'demo/general/image_home_mix_2.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
            ['file_name' => 'image_home_mix_3', 'file_path' => 'demo/general/image_home_mix_3.jpg', 'file_type' => 'image/jpeg', 'file_extension' => 'jpg'],
        ]);


    }
}
