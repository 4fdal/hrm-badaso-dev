<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchProductCategoryToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_product_category_toppings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_product_category_id')->nullable(); 
            $table->string("name")->nullable(); 

            $table->foreign('lunch_product_category_id')->references('id')->on('lunch_product_category_toppings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_product_category_toppings');
    }
}