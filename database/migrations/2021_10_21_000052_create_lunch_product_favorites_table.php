<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchProductFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_product_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_product_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 

            $table->foreign('lunch_product_id')->references('id')->on('lunch_products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_product_favorites');
    }
}