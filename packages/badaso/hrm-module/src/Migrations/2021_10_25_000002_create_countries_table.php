<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'countries', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("code")->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->string("phone_code")->nullable();
            $table->string("name_position")->nullable();
            $table->string("vat_label")->nullable();
            $table->timestamps();

            $table->foreign('currency_id')->references('id')->on(config('badaso.database.prefix') . 'currencies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix') . 'countries');
    }
}
