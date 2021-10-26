<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxCurrentAccountJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'tax_current_account_journals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tax_account_payables')->nullable(); 
            $table->unsignedBigInteger('account_journal_id')->nullable(); 

            $table->foreign('tax_account_payables')->references('id')->on(config('badaso.database.prefix').'tax_account_payables')->onDelete('cascade');
            $table->foreign('account_journal_id')->references('id')->on(config('badaso.database.prefix').'account_journals')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'tax_current_account_journals');
    }
}