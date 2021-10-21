<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_contracts', function (Blueprint $table) {
            $table->id();
            $table->integer("responsible_user_id")->nullable(); 
            $table->integer("fleet_contract_type_id")->nullable(); 
            $table->integer("vendor_parent_id")->nullable(); 
            $table->string("reference")->nullable(); 
            $table->double("activation_cost")->nullable(); 
            $table->double("recurring_cost")->nullable(); 
            $table->string("recurring_cost_frequency")->nullable(); // no, daily, weekly, monthly, yearly 
            $table->integer("fleet_vehicle_id")->nullable(); 
            $table->date("invoice_date")->nullable(); 
            $table->date("contract_start_date")->nullable(); 
            $table->date("contract_expiration_date")->nullable(); 
            $table->string("terms_conditions")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fleet_contracts');
    }
}