<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_toppings', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->integer("company_id")->nullable(); 
            $table->double("price")->nullable(); 
            $table->integer("lunch_product_category_topping_id")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_toppings');
    }
}