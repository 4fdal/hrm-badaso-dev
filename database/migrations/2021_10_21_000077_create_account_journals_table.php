<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_journals', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->string("code")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("type")->nullable(); // sale, purchase, general, bank, cash 
            $table->unsignedBigInteger('default_account_id')->nullable(); 
            $table->unsignedBigInteger('payment_debit_account_id')->nullable(); 
            $table->unsignedBigInteger('payment_credit_account_id')->nullable(); 
            $table->unsignedBigInteger('suspensi_account_id')->nullable(); 
            $table->integer("sequnce")->nullable(); 
            $table->string("invoice_reference_type")->nullable(); 
            $table->string("invoice_reference_model")->nullable(); 
            $table->unsignedBigInteger('currency_id')->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->boolean("is_refund_squence")->nullable(); 
            $table->boolean("is_least_one_inbound")->nullable(); 
            $table->boolean("is_least_one_outbound")->nullable(); 
            $table->unsignedBigInteger('profit_account_id')->nullable(); 
            $table->unsignedBigInteger('lost_account_id')->nullable(); 
            $table->unsignedBigInteger('partner_bank_id')->nullable(); 

            $table->foreign('default_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('payment_debit_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('payment_credit_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('suspensi_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('profit_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('lost_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('partner_bank_id')->references('id')->on('partner_banks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_journals');
    }
}