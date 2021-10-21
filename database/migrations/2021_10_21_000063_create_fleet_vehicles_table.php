<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_model_id')->nullable(); 
            $table->unsignedBigInteger('fleet_model_brand_id')->nullable(); 
            $table->string("name")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("vin_sn")->nullable(); 
            $table->string("description")->nullable(); 
            $table->string("license_plate")->nullable(); 
            $table->unsignedBigInteger('fleet_state_id')->nullable(); 
            $table->unsignedBigInteger('driver_partner_id')->nullable(); 
            $table->unsignedBigInteger('future_driver_partner_id')->nullable(); 
            $table->boolean("is_plan_change_card")->nullable(); 
            $table->date("assignment_date")->nullable(); 
            $table->string("localtion")->nullable(); 
            $table->unsignedBigInteger('manager_user_id')->nullable(); 
            $table->date("first_contract_date")->nullable(); 
            $table->double("last_odometer")->nullable(); 
            $table->string("unit_odometer")->nullable(); 
            $table->date("immatriculation_date")->nullable(); 
            $table->string("chassis_number")->nullable(); 
            $table->double("catalog_value")->nullable(); 
            $table->double("purchase_value")->nullable(); 
            $table->double("residual_value")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->string("seats_number")->nullable(); 
            $table->string("doors_number")->nullable(); 
            $table->string("color")->nullable(); 
            $table->year("model_year")->nullable(); 
            $table->string("transmission")->nullable(); // manual, automatic 
            $table->string("fuel_type")->nullable(); // gasoline, diesel, lpg, electric, hybrid 
            $table->double("c02_emission")->nullable(); 
            $table->double("horsepower")->nullable(); 
            $table->double("horsepower_taxation")->nullable(); 
            $table->double("power")->nullable(); 

            $table->foreign('fleet_model_id')->references('id')->on('fleet_models')->onDelete('cascade');
            $table->foreign('fleet_model_brand_id')->references('id')->on('fleet_model_brands')->onDelete('cascade');
            $table->foreign('fleet_state_id')->references('id')->on('fleet_states')->onDelete('cascade');
            $table->foreign('driver_partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->foreign('future_driver_partner_id')->references('id')->on('partners')->onDelete('cascade');
            $table->foreign('manager_user_id')->references('id')->on('badaso_users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet_vehicles');
    }
}