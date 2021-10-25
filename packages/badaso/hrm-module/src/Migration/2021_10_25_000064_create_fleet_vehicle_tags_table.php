<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetVehicleTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_vehicle_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_vehicle_id')->nullable(); 
            $table->unsignedBigInteger('fleet_vehicle_categorie_id')->nullable(); 

            $table->foreign('fleet_vehicle_id')->references('id')->on(config('badaso.database.prefix').'fleet_vehicles')->onDelete('cascade');
            $table->foreign('fleet_vehicle_categorie_id')->references('id')->on(config('badaso.database.prefix').'fleet_vehicle_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_vehicle_tags');
    }
}