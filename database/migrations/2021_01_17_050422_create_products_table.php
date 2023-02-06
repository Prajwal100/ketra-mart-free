<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('slug',200)->unique();

            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();

            $table->integer('current_stock')->default(0);
            $table->string('product_label')->nullable();

            $table->unsignedBigInteger('cat_ids');
            $table->string('unit')->nullable();
            $table->integer('min_qty')->default(1);
            $table->tinyInteger('refundable')->default(1);

            $table->text('thumbnail_image')->nullable();
            $table->text('images')->nullable();

            $table->boolean('is_featured')->default(0)->nullable();

            $table->decimal('unit_price')->default(0);
            $table->decimal('purchase_price')->default(0);
            $table->decimal('discount')->nullable()->default(0);
            $table->string('discount_type', 80)->nullable();



            $table->text('colors')->nullable();
            $table->boolean('variant_products')->default(0);
            $table->text('attributes')->nullable();
            $table->text('choice_options')->nullable();
            $table->text('variation')->nullable();


            //Shipping configuration
            $table->string('processing_time')->nullable();
            $table->string('shipping_time')->nullable();

            $table->unsignedBigInteger('user_id')->default('1');
            $table->string('added_by')->default('admin');
            $table->enum('status',['active','inactive'])->default('active');

            //SEO section
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
