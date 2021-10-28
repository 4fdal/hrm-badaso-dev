<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'fleet_models', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->unsignedBigInteger('fleet_model_brand_id')->nullable();
            $table->unsignedBigInteger('manager_user_id')->nullable();
            $table->boolean("is_active")->nullable();
            $table->string("vehicle_type")->nullable(); // car, bike

            $table->foreign('fleet_model_brand_id')->references('id')->on(config('badaso.database.prefix').'fleet_model_brands')->onDelete('cascade');
            $table->foreign('manager_user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'fleet_models');
    }
}
