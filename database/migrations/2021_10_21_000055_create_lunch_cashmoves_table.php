<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchCashmovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lunch_cashmoves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->date("date")->nullable(); 
            $table->double("amount")->nullable(); 
            $table->string("description")->nullable(); 

            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('badaso_users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lunch_cashmoves');
    }
}