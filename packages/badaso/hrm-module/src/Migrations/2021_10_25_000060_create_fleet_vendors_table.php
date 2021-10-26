<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fleet_model_id')->nullable(); 
            $table->unsignedBigInteger('partner_id')->nullable(); 

            $table->foreign('fleet_model_id')->references('id')->on(config('badaso.database.prefix').'fleet_models')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on(config('badaso.database.prefix').'partners')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_vendors');
    }
}