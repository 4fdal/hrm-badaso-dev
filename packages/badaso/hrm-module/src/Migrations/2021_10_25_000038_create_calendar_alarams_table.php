<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarAlaramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'calendar_alarams', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("alaram_type")->nullable(); // notification, email 
            $table->integer("duration")->nullable(); 
            $table->string("interval")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'calendar_alarams');
    }
}