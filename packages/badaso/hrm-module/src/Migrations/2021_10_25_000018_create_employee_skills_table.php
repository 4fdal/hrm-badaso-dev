<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'employee_skills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_type_id')->nullable();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->unsignedBigInteger('skill_level_id')->nullable();

            $table->foreign('skill_type_id')->references('id')->on(config('badaso.database.prefix') . 'skill_types')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on(config('badaso.database.prefix') . 'skills')->onDelete('cascade');
            $table->foreign('skill_level_id')->references('id')->on(config('badaso.database.prefix') . 'skill_levels')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'employee_skills');
    }
}
