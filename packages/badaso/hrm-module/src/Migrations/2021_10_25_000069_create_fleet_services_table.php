<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_services', function (Blueprint $table) {
            $table->id();
            $table->string("description")->nullable(); 
            $table->unsignedBigInteger('fleet_service_type_id')->nullable(); 
            $table->date("date")->nullable(); 
            $table->double("cost")->nullable(); 
            $table->unsignedBigInteger('vendor_parent_id')->nullable(); 
            $table->unsignedBigInteger('fleet_vehicle_id')->nullable(); 
            $table->unsignedBigInteger('driver_partner_id')->nullable(); 
            $table->double("odometer_value")->nullable(); 
            $table->string("notes")->nullable(); 

            $table->foreign('fleet_service_type_id')->references('id')->on(config('badaso.database.prefix').'fleet_service_types')->onDelete('cascade');
            $table->foreign('vendor_parent_id')->references('id')->on(config('badaso.database.prefix').'fleet_service_types')->onDelete('cascade');
            $table->foreign('fleet_vehicle_id')->references('id')->on(config('badaso.database.prefix').'fleet_vehicles')->onDelete('cascade');
            $table->foreign('driver_partner_id')->references('id')->on(config('badaso.database.prefix').'partners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_services');
    }
}