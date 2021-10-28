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
        Schema::create(config('badaso.database.prefix') . 'recruitment_sources', function (Blueprint $table) {
            $table->id();
            $table->string("source")->nullable();
            $table->unsignedBigInteger('recruitment_id')->nullable();

            $table->foreign('recruitment_id')->references('id')->on(config('badaso.database.prefix') . 'recruitments')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'recruitment_sources');
    }
}
