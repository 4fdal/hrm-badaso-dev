<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'account_taxes', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("type_tax_use")->nullable(); // sale, purchase
            $table->string("tax_scope")->nullable();
            $table->string("amount_type")->nullable();
            $table->boolean("is_active")->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->integer("sequnce")->nullable();
            $table->double("amount")->nullable();
            $table->string("description")->nullable();

            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'account_taxes');
    }
}
