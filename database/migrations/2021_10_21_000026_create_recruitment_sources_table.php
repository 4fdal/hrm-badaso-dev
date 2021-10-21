<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment_sources', function (Blueprint $table) {
            $table->id();
            $table->string("source")->nullable(); 
            $table->unsignedBigInteger('recruitment_id')->nullable(); 

            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_sources');
    }
}