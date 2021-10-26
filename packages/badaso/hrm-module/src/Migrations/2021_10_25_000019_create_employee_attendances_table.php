<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'employee_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->string("check_in")->nullable(); 
            $table->string("check_out")->nullable(); 
            $table->double("worked_hours")->nullable(); 

            $table->foreign('employee_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'employee_attendances');
    }
}