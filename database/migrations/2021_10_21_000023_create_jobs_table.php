<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->integer("no_of_employee")->nullable(); 
            $table->integer("no_of_recruitment")->nullable(); 
            $table->integer("no_of_hired_employee")->nullable(); 
            $table->string("reqruitment")->nullable(); 
            $table->unsignedBigInteger('departement_id')->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->string("description")->nullable(); 
            $table->string("state")->nullable(); 
            $table->integer("address_id")->nullable(); 
            $table->unsignedBigInteger('manager_id')->nullable(); 

            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}