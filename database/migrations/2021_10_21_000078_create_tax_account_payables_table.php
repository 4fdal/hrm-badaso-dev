<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxAccountPayablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_account_payables', function (Blueprint $table) {
            $table->id();
            $table->string("code")->nullable(); 
            $table->unsignedBigInteger('group_account_type_id')->nullable(); 
            $table->boolean("is_deprecated")->nullable(); 
            $table->unsignedBigInteger('default_account_tax_id')->nullable(); 

            $table->foreign('group_account_type_id')->references('id')->on('account_types')->onDelete('cascade');
            $table->foreign('default_account_tax_id')->references('id')->on('account_taxes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_account_payables');
    }
}