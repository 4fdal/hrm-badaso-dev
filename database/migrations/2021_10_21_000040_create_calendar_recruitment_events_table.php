<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarRecruitmentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_recruitment_events', function (Blueprint $table) {
            $table->id();
            $table->boolean("done_status")->nullable(); 
            $table->unsignedBigInteger('calendar_event_id')->nullable(); 

            $table->foreign('calendar_event_id')->references('id')->on('calendar_events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendar_recruitment_events');
    }
}