<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingDistributionCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'accounting_distribution_credit_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accounting_tax_id')->nullable();
            $table->double("percent")->nullable();
            $table->string("base_on")->nullable(); // base, tax
            $table->integer("account_id")->nullable();
            $table->string("tax_grids")->nullable();
            $table->boolean("is_close_entry")->nullable();

            $table->foreign('accounting_tax_id', 'adcn_ref_accounting_tax_id')->references('id')->on(config('badaso.database.prefix') . 'accounting_taxes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix') . 'accounting_distribution_credit_notes');
    }
}
