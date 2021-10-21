<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->double("cost")->nullable(); 
            $table->string("internal_reference")->nullable(); 
            $table->integer("company_id")->nullable(); 
            $table->string("invoice_policy")->nullable(); // ordered => Ordered Quantity, delivered => Delivered Quantity 
            $table->string("re_invoice_exoense")->nullable(); // no, cost, sales_price 
            $table->string("image_path")->nullable(); 


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_products');
    }
}