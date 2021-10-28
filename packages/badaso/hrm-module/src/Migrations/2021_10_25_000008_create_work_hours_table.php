<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'work_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id')->nullable();
            $table->string("name")->nullable();
            $table->string("day_of_week")->nullable();
            $table->string("day_period")->nullable();
            $table->time("work_from")->nullable();
            $table->time("work_to")->nullable();
            $table->string("start_date")->nullable();
            $table->string("end_date")->nullable();

            $table->foreign('work_id')->references('id')->on(config('badaso.database.prefix') . 'workes')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'work_hours');
    }
}
