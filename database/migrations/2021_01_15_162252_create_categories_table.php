<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('banner')->nullable();
            $table->string('icon')->nullable();

            $table->integer('level')->default(0)->nullable();
            $table->integer('position')->default(0)->nullable();

            $table->integer('parent_id')->default(0)->nullable();
            $table->boolean('is_menu')->default(false);
            $table->boolean('featured')->default(0)->nullable();
            $table->enum('status',['active','inactive'])->default('active');

            $table->text('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
