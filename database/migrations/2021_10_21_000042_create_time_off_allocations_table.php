<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeOffAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_off_allocations', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->unsignedBigInteger('time_off_type_id')->nullable(); 
            $table->string("allocation_types")->nullable(); // regular, accrual 
            $table->double("number_of_day")->nullable(); 
            $table->string("holiday_mode")->nullable(); // employee, company, departement, category 
            $table->unsignedBigInteger('for_employee_id')->nullable(); 
            $table->unsignedBigInteger('for_company_id')->nullable(); 
            $table->unsignedBigInteger('for_departement_id')->nullable(); 
            $table->unsignedBigInteger('for_employee_categorie_id')->nullable(); 
            $table->string("description")->nullable(); 
            $table->unsignedBigInteger('first_approve_employee_id')->nullable(); 
            $table->unsignedBigInteger('second_approve_employee_id')->nullable(); 

            $table->foreign('time_off_type_id')->references('id')->on('time_off_types')->onDelete('cascade');
            $table->foreign('for_employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('for_company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('for_departement_id')->references('id')->on('departements')->onDelete('cascade');
            $table->foreign('for_employee_categorie_id')->references('id')->on('employee_categories')->onDelete('cascade');
            $table->foreign('first_approve_employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('second_approve_employee_id')->references('id')->on('employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_off_allocations');
    }
}