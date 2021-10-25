<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'currencies', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("sysmbol")->nullable(); 
            $table->double("rounding")->nullable(); 
            $table->integer("decimal_place")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("position")->nullable(); // after, before 
            $table->string("currency_unit_label")->nullable(); 
            $table->string("currency_subunit_label")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'currencies');
    }
}