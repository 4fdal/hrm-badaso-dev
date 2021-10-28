<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetContractServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_contract_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_contract_id')->nullable();
            $table->unsignedBigInteger('fleet_service_type_id')->nullable();

            $table->foreign('fleet_contract_id')->references('id')->on(config('badaso.database.prefix').'fleet_contracts')->onDelete('cascade');
            $table->foreign('fleet_service_type_id')->references('id')->on(config('badaso.database.prefix').'fleet_service_types')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_contract_services');
    }
}
