<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->longText('product_details')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price')->default(0);
            $table->decimal('discount')->default(0);
            $table->longText('variation')->nullable();
            $table->longText('variant')->nullable();
            $table->unsignedBigInteger('shipping_method_id')->nullable();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');
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
        Schema::dropIfExists('order_details');
    }
}
