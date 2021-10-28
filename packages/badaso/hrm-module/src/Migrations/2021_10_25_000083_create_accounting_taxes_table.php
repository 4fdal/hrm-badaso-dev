<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'accounting_taxes', function (Blueprint $table) {
            $table->id();
            $table->string("tax_name")->nullable();
            $table->string("tax_computation")->nullable(); // group, fixed, percent, division
            $table->boolean("is_active")->nullable();
            $table->string("tax_type")->nullable(); // sale, purchase, none
            $table->string("tax_score")->nullable(); // services, goods
            $table->double("amount")->nullable();
            $table->string("accountig_type")->nullable();
            $table->string("label_invoice")->nullable();
            $table->integer("taxes_group_id")->nullable();
            $table->boolean("is_include_price")->nullable();
            $table->boolean("is_subsequent_tax")->nullable();


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
        Schema::dropIfExists(config('badaso.database.prefix').'accounting_taxes');
    }
}
