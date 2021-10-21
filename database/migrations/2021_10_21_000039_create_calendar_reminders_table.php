<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_event_id')->nullable(); 
            $table->unsignedBigInteger('calendar_alaram_id')->nullable(); 

            $table->foreign('calendar_event_id')->references('id')->on('calendar_events')->onDelete('cascade');
            $table->foreign('calendar_alaram_id')->references('id')->on('calendar_alarams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_reminders');
    }
}