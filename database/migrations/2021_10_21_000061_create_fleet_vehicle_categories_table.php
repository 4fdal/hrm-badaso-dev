<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetVehicleCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("color")->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 

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
        Schema::dropIfExists('fleet_vehicle_categories');
    }
}