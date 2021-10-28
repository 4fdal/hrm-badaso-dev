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
        Schema::create(config('badaso.database.prefix') . 'expense_customer_accounting_tax', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_product_id')->nullable();
            $table->unsignedBigInteger('accounting_tax_id')->nullable();

            $table->foreign('expense_product_id', 'ecat_ref_expense_product_id')->references('id')->on(config('badaso.database.prefix') . 'expense_products')->onDelete('cascade');
            $table->foreign('accounting_tax_id', 'ecat_ref_accounting_tax_id')->references('id')->on(config('badaso.database.prefix') . 'accounting_taxes')->onDelete('cascade');
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix') . 'expense_customer_accounting_tax');
    }
}
