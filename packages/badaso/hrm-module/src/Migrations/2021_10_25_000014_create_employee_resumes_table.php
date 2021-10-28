<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'employee_resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('resume_line_type_id')->nullable();
            $table->string("display_type")->nullable(); // classic
            $table->date("start")->nullable();
            $table->date("end")->nullable();
            $table->string("description")->nullable();

            $table->foreign('employee_id')->references('id')->on(config('badaso.database.prefix') . 'employees')->onDelete('cascade');
            $table->foreign('resume_line_type_id')->references('id')->on(config('badaso.database.prefix') . 'resume_line_types')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix') . 'employee_resumes');
    }
}
