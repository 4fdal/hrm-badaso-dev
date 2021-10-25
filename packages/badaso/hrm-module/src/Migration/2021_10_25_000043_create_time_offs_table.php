<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'time_offs', function (Blueprint $table) {
            $table->id();
            $table->string("private_name")->nullable();
            $table->string("status")->nullable(); // confirm, validate
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('manager_employee_id')->nullable();
            $table->unsignedBigInteger('time_off_type_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->string("notes")->nullable();
            $table->string("date_from")->nullable();
            $table->string("date_to")->nullable();
            $table->double("number_of_day")->nullable();
            $table->string("duration_display")->nullable();
            $table->unsignedBigInteger('metting_calendar_event_id')->nullable();

            $table->foreign('user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');
            $table->foreign('manager_employee_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');
            $table->foreign('time_off_type_id')->references('id')->on(config('badaso.database.prefix').'time_off_types')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');
            $table->foreign('departement_id')->references('id')->on(config('badaso.database.prefix').'departements')->onDelete('cascade');
            $table->foreign('metting_calendar_event_id')->references('id')->on(config('badaso.database.prefix').'calendar_events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'time_offs');
    }
}
