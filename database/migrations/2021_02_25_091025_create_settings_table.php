<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('logo');
            $table->string('favicon')->nullable();
            $table->string('phone',200);
            $table->string('office_time')->nullable();
            $table->string('email',200);
            $table->text('address');

            $table->string('currency')->default('$');
            $table->string('system_version')->nullable()->default('1.0');
            $table->string('website_url')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();

            $table->boolean('recaptcha')->default(0);
            $table->string('recaptcha_key')->nullable();
            $table->string('recaptcha_secret')->nullable();
            $table->integer('visitors')->default(0);
            $table->string('copyright_text')->default('© Copyrights 2023. All rights reserved.');

            // other pages
            $table->longText('about_us')->nullable();
            $table->longText('return_policy')->nullable();
            $table->longText('shipping_payment')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_conditions')->nullable();
            $table->longText('cancellation_policy')->nullable();
            $table->boolean('paypal_sandbox')->default(1);
            $table->integer('delivery_time')->default(20);
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
        Schema::dropIfExists('settings');
    }
}
