<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'expense_reports', function (Blueprint $table) {
            $table->id();
            $table->string("description")->nullable(); 
            $table->unsignedBigInteger('expense_product_id')->nullable(); 
            $table->double("unit_price")->nullable(); 
            $table->double("quantity")->nullable(); 
            $table->double("total")->nullable(); 
            $table->double("amount_due")->nullable(); 
            $table->string("paid_by")->nullable(); // own_account, company_account 
            $table->string("bill_reference")->nullable(); 
            $table->date("expense_date")->nullable(); 
            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->string("note")->nullable(); 
            $table->string("state_report")->nullable(); // approve, draft, refuse, post, register_payment, payed 
            $table->integer("register_payment_id")->nullable(); 

            $table->foreign('expense_product_id')->references('id')->on(config('badaso.database.prefix').'expense_products')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on(config('badaso.database.prefix').'employees')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'expense_reports');
    }
}