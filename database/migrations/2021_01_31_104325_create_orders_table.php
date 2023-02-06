<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_number',20)->unique();
            $table->float('total_amount')->default(0);
            $table->float('subtotal')->default(0);
            $table->string('payment_method')->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('order_status',['pending','process','delivered','cancelled'])->default('pending');
            $table->longText('payment_details')->nullable();
            $table->float('delivery_charge')->default(0)->nullable();
            $table->integer('quantity')->default(0);
            $table->float('coupon')->default(0)->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->integer('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();


            $table->string('scountry')->nullable();
            $table->integer('spostcode')->nullable();
            $table->string('sstate')->nullable();
            $table->string('saddress')->nullable();
            $table->string('saddress2')->nullable();
            $table->text('note')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
