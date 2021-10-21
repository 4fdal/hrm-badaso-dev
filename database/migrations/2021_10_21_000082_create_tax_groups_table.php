<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('current_tax_account_payable_id')->nullable(); 
            $table->unsignedBigInteger('advanced_tax_account_payable_id')->nullable(); 
            $table->integer("sequnce")->nullable(); 
            $table->unsignedBigInteger('receiver_current_tax_account_payable_id')->nullable(); 

            $table->foreign('current_tax_account_payable_id')->references('id')->on('tax_account_payables')->onDelete('cascade');
            $table->foreign('advanced_tax_account_payable_id')->references('id')->on('tax_account_payables')->onDelete('cascade');
            $table->foreign('receiver_current_tax_account_payable_id')->references('id')->on('tax_account_payables')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_groups');
    }
}