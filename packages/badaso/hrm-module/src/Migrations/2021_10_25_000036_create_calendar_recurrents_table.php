<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarRecurrentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'calendar_recurrents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_event_id')->nullable();
            $table->string("name")->nullable();
            $table->string("event_tz")->nullable();
            $table->string("rrule")->nullable();
            $table->string("rrule_type")->nullable();
            $table->string("end_type")->nullable();
            $table->integer("interval")->nullable();
            $table->integer("count")->nullable();
            $table->boolean("mo")->nullable();
            $table->boolean("tu")->nullable();
            $table->boolean("we")->nullable();
            $table->boolean("th")->nullable();
            $table->boolean("fr")->nullable();
            $table->boolean("sa")->nullable();
            $table->boolean("su")->nullable();
            $table->string("month_by")->nullable();
            $table->integer("day")->nullable();
            $table->string("byday")->nullable();
            $table->date("until")->nullable();

            $table->foreign('calendar_event_id')->references('id')->on(config('badaso.database.prefix').'calendar_events')->onDelete('cascade');

        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'calendar_recurrents');
    }
}
