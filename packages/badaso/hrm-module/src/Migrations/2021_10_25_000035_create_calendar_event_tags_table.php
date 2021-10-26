<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'calendar_event_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('calendar_event_id')->nullable(); 
            $table->unsignedBigInteger('calendar_event_category_id')->nullable(); 

            $table->foreign('calendar_event_id')->references('id')->on(config('badaso.database.prefix').'calendar_events')->onDelete('cascade');
            $table->foreign('calendar_event_category_id')->references('id')->on(config('badaso.database.prefix').'calendar_event_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'calendar_event_tags');
    }
}