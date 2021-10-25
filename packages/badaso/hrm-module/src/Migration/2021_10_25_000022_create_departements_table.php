<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'departements', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("complete_name")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->unsignedBigInteger('parent_id')->nullable(); 
            $table->unsignedBigInteger('manager_id')->nullable(); 
            $table->string("note")->nullable(); 
            $table->string("color")->nullable(); 

            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on(config('badaso.database.prefix').'departements')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'departements');
    }
}