<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_tags', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("applicability")->nullable(); // accounts, taxes 
            $table->boolean("is_active")->nullable(); 
            $table->unsignedBigInteger('country_id')->nullable(); 

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_tags');
    }
}