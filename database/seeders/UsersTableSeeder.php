<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
//            Customer
            [
                'full_name'=>'Mr. Customer',
                'username'=>'Customer',
                'email'=>'customer@gmail.com',
                'password'=>Hash::make('111111'),
                'status'=>'active',
            ],
        ]);

        DB::table('admins')->insert([

//            Admin
            [
                'name'=>'Mr. Admin',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin123'),
                'status'=>'active',
                'is_admin'=>1,
            ],
        ]);
    }
}
