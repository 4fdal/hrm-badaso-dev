<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'calendar_events', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->date("start")->nullable();
            $table->date("stop")->nullable();
            $table->boolean("is_all_day")->nullable();
            $table->double("duration")->nullable();
            $table->string("description")->nullable();
            $table->string("privacy")->nullable();
            $table->string("localtion")->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean("is_active")->nullable();
            $table->boolean("is_recurrent")->nullable();
            $table->string("show_as")->nullable(); // busy, free

            $table->foreign('user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'calendar_events');
    }
}
