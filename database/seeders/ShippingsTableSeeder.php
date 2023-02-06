<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shippings')->insert([
            [
                'shipping_address'=>'China',
                'delivery_time'=>'4-5 days',
                'delivery_charge'=>100.00,
                'status'=>'active',
            ],
            [
                'shipping_address'=>'Nepal',
                'delivery_time'=>'8-9 days',
                'delivery_charge'=>300.00,
                'status'=>'active',
            ]
        ]);
    }
}
