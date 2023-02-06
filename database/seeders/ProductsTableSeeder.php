<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();

        \DB::table('products')->insert([
            [
                'id'             => 1,
                'title'          => 'Canon EOS185',
                'slug'           => 'canon-eos185',
                'summary'        =>'<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>',
                'description'    => '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>',
                'current_stock'          =>100,
                'product_label'  =>'new',
                'cat_ids'        => 2,
                'unit'           =>'pc',
                'min_qty'        => 5,
                'refundable'     => '0',
                'thumbnail_image'=>'frontend/assets/images/products/1.jpg',
                'is_featured'    => 1,
                'unit_price'     => 324.36,
                'purchase_price' => 324.36,
                'discount'       => 0,
                'discount_type'  => 'amount',
                'colors'         => '[]',
                'variant_products'=>0,
                'attributes'     =>'null',
                'choice_options' =>'[]',
                'user_id'        => 1,
                'added_by'       => 'admin',
                'status'         => 'active',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'id'             => 2,
                'title'          => 'Test Product',
                'slug'           => 'test-product',
                'summary'        =>'<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>',
                'description'    => '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>',
                'current_stock'  =>100,
                'product_label'  =>'new',
                'cat_ids'        => 1,
                'unit'           =>'pc',
                'min_qty'        => 5,
                'refundable'     => '0',
                'thumbnail_image'=>'frontend/assets/images/products/2.jpg',
                'is_featured'    => 1,
                'unit_price'     => 100,
                'purchase_price' => 90,
                'discount'       => 10,
                'discount_type'  => 'amount',
                'colors'         => '[]',
                'variant_products'=>0,
                'attributes'     =>'null',
                'choice_options' =>'[]',
                'user_id'        => 1,
                'added_by'       => 'admin',
                'status'         => 'active',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'id'             => 3,
                'title'          => 'Test Product 2',
                'slug'           => 'test-product-2',
                'summary'        =>'<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution.</p>',
                'description'    => '<p>The biggest change in the\\u00a0<strong>Canon EOS 1500D</strong>\\u00a0is the sensor resolution. It\'s now a 24.1-megapixel APS-C sensor, compared to the 18-megapixel APS-C sensor on the 1300D. ... Just like the 1300D, the\\u00a0<strong>EOS 1500D<\\/strong>\\u00a0features NFC and Wi-Fi for connecting it to your smartphone<\\/p>',
                'current_stock'  =>100,
                'product_label'  =>'new',
                'cat_ids'        => 2,
                'unit'           =>'pc',
                'min_qty'        => 5,
                'refundable'     => '0',
                'thumbnail_image'=>'frontend/assets/images/products/3.jpg',
                'is_featured'    => 1,
                'unit_price'     => 1000,
                'purchase_price' => 500,
                'discount'       => 50,
                'discount_type'  => 'percent',
                'colors'         => '[]',
                'variant_products'=>0,
                'attributes'     =>'null',
                'choice_options' =>'[]',
                'user_id'        => 1,
                'added_by'       => 'admin',
                'status'         => 'active',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ]
        ]);
    }
}
