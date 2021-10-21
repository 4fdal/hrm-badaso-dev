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
        Schema::create('employee_resumes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->unsignedBigInteger('resume_line_type_id')->nullable(); 
            $table->string("display_type")->nullable(); // classic 
            $table->date("start")->nullable(); 
            $table->date("end")->nullable(); 
            $table->string("description")->nullable(); 

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('resume_line_type_id')->references('id')->on('resume_line_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_resumes');
    }
}