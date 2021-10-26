<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchOrderToppingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_order_toppings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_order_id')->nullable(); 
            $table->unsignedBigInteger('lunch_topping_id')->nullable(); 

            $table->foreign('lunch_order_id')->references('id')->on(config('badaso.database.prefix').'lunch_orders')->onDelete('cascade');
            $table->foreign('lunch_topping_id')->references('id')->on(config('badaso.database.prefix').'lunch_toppings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_order_toppings');
    }
}