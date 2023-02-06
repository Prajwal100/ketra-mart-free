<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

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

            $table->foreign('user_id')->on('users')->references('id')->onDelete('CASCADE');

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
        Schema::dropIfExists('shipping_addresses');
    }
}
