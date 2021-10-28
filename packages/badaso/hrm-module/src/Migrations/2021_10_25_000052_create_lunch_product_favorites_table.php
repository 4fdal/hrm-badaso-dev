<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchProductFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_product_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_product_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('lunch_product_id')->references('id')->on(config('badaso.database.prefix').'lunch_products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_product_favorites');
    }
}
