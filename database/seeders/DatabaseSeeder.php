<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BannersTableSeeder::class,
            CategoriesTableSeeder::class,
            MediaFileSeeder::class,

            ProductAttributesTableSeeder::class,
            ProductsTableSeeder::class,

            CurrencyTableSeeder::class,
            ShippingsTableSeeder::class,
            UsersTableSeeder::class,

            SettingTableSeeder::class,

        ]);
//         \App\Models\Product::factory(100)->create();
//         \App\Models\ProductReview::factory(100)->create();
    }

}
