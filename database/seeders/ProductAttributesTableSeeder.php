<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->insert([
            [
                'name'=>"Color",
                'has_color'=>1
            ],
            [
                'name'=>"Size",
                'has_color'=>0
            ],
        ]);

        DB::table('attribute_values')->insert([
            [
                'name'=>"L",
                'color_code'=>'',
                'attribute_id'=>2
            ],
            [
                'name'=>"S",
                'color_code'=>'',
                'attribute_id'=>2
            ],
            [
                'name'=>"M",
                'color_code'=>'',
                'attribute_id'=>2
            ],
            [
                'name'=>"XL",
                'color_code'=>'',
                'attribute_id'=>2
            ],
            [
                'name'=>"White",
                'color_code'=>'#FFFFFF',
                'attribute_id'=>1
            ],
            [
                'name'=>"Black",
                'color_code'=>'#000000',
                'attribute_id'=>1
            ],
        ]);

    }
}
