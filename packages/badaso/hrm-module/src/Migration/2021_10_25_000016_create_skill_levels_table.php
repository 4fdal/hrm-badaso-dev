<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'skill_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_type_id')->nullable(); 
            $table->string("name")->nullable(); 
            $table->double("level_progress")->nullable(); 

            $table->foreign('skill_type_id')->references('id')->on(config('badaso.database.prefix').'skill_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'skill_levels');
    }
}