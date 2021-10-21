<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseCustomerAccountingTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_customer_accounting_tax', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_product_id')->nullable(); 
            $table->unsignedBigInteger('accounting_tax_id')->nullable(); 

            $table->foreign('expense_product_id')->references('id')->on('expense_products')->onDelete('cascade');
            $table->foreign('accounting_tax_id')->references('id')->on('accounting_taxes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_customer_accounting_tax');
    }
}