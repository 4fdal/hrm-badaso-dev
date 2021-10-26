<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'employee_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->unsignedBigInteger('employee_categorie_id')->nullable(); 

            $table->foreign('employee_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');
            $table->foreign('employee_categorie_id')->references('id')->on(config('badaso.database.prefix').'employee_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'employee_tags');
    }
}