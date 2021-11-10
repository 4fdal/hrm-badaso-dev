<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'recruitments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->nullable();
            $table->double("is_favorite")->nullable();
            $table->integer("no_of_application")->nullable();
            $table->integer("no_of_to_recruit")->default(1)->nullable();
            $table->integer("no_of_new_application")->nullable();
            $table->boolean('is_recruitment_done')->default(false) ;
            $table->string("color")->nullable();

            $table->foreign('job_id')->references('id')->on(config('badaso.database.prefix') . 'jobs')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'recruitments');
    }
}
