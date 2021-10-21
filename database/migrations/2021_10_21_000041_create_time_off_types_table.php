<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeOffTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_off_types', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_create_calendar")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("color")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->string("name")->nullable(); 
            $table->string("payroll_code")->nullable(); 
            $table->string("take_time_off_types")->nullable(); // day, half day,hours 
            $table->unsignedBigInteger('responsible_user_id')->nullable(); 
            $table->string("allocation_types")->nullable(); // no => no limit, fixed => set by time off officer, fixed_allocation => allow employes request 
            $table->string("allocation_validation_types")->nullable(); // hr => time off by officer , both => by employee manager, manager => by employee manager and time office 
            $table->date("validity_start")->nullable(); 
            $table->date("validity_stop")->nullable(); 
            $table->string("time_off_validation_types")->nullable(); 

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('responsible_user_id')->references('id')->on('badaso_users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_off_types');
    }
}