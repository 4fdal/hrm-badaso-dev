<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->time("average_hours_per_day")->nullable(); 
            $table->string("timezone")->nullable(); 

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workes');
    }
}