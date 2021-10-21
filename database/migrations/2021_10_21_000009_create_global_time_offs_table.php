<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlobalTimeOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_time_offs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worke_id')->nullable(); 
            $table->string("reason")->nullable(); 
            $table->string("start_date")->nullable(); 
            $table->string("end_date")->nullable(); 

            $table->foreign('worke_id')->references('id')->on('workes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('global_time_offs');
    }
}