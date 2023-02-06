<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            [
                'name'=>'US dollar',
                'symbol'=>'$',
                'exchange_rate'=>1,
                'code'=>'USD',
                'flag'=>'frontend/assets/img/us-flag.jpg',
                'flag_path'=>'frontend/assets/img/us-flag.jpg',
                'status'=>'active',
            ],
            [
                'name'=>'Spain Euro',
                'symbol'=>'€',
                'exchange_rate'=>0.82,
                'code'=>'SPA',
                'flag'=>'frontend/assets/img/spain-flag.jpg',
                'flag_path'=>'frontend/assets/img/spain-flag.jpg',
                'status'=>'active',
            ],
            [
                'name'=>'Russian Ruble',
                'symbol'=>'₽',
                'exchange_rate'=>72.86,
                'code'=>'RUS',
                'flag'=>'frontend/assets/img/russia-flag.jpg',
                'flag_path'=>'frontend/assets/img/russia-flag.jpg',
                'status'=>'active',
            ],
            [
                'name'=>'France Euro',
                'symbol'=>'€',
                'exchange_rate'=>0.82,
                'code'=>'FRA',
                'flag'=>'frontend/assets/img/france-flag.jpg',
                'flag_path'=>'frontend/assets/img/france-flag.jpg',
                'status'=>'active',
            ],
        ]);
    }
}
