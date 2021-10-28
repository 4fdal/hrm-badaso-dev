<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchVendorsLocationOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_vendors_location_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_vendor_id')->nullable(); 
            $table->unsignedBigInteger('lunch_locations_id')->nullable(); 

            $table->foreign('lunch_locations_id')->references('id')->on(config('badaso.database.prefix').'lunch_locations')->onDelete('cascade');
            $table->foreign('lunch_vendor_id')->references('id')->on(config('badaso.database.prefix').'lunch_vendors')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_vendors_location_orders');
    }
}