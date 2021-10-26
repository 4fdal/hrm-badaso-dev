<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchAlertLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_alert_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_alert_id')->nullable(); 
            $table->unsignedBigInteger('lunch_location_id')->nullable(); 

            $table->foreign('lunch_alert_id')->references('id')->on(config('badaso.database.prefix').'lunch_alerts')->onDelete('cascade');
            $table->foreign('lunch_location_id')->references('id')->on(config('badaso.database.prefix').'lunch_locations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_alert_locations');
    }
}