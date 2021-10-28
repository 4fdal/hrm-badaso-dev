<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetOdometersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_odometers', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("date")->nullable();
            $table->double("value")->nullable();
            $table->unsignedBigInteger('fleet_vehicle_id')->nullable();

            $table->foreign('fleet_vehicle_id')->references('id')->on(config('badaso.database.prefix').'fleet_vehicles')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_odometers');
    }
}
