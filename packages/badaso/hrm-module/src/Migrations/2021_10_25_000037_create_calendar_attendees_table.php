<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'calendar_attendees', function (Blueprint $table) {
            $table->id();
            $table->string("common_name")->nullable();
            $table->unsignedBigInteger('calendar_event_id')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();

            $table->foreign('calendar_event_id')->references('id')->on(config('badaso.database.prefix').'calendar_events')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on(config('badaso.database.prefix').'partners')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'calendar_attendees');
    }
}
