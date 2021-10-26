<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'accounts', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->unsignedBigInteger('currency_id')->nullable(); 
            $table->string("code")->nullable(); 
            $table->boolean("is_deprecated")->nullable(); 
            $table->unsignedBigInteger('account_type_id')->nullable(); 
            $table->string("internal_type")->nullable(); // other, liquidity, receivable 
            $table->string("internal_global")->nullable(); 
            $table->boolean("is_reconcile")->nullable(); 
            $table->string("note")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->unsignedBigInteger('account_group_id')->nullable(); 
            $table->boolean("root_id")->nullable(); 
            $table->boolean("is_off_balance")->nullable(); 

            $table->foreign('currency_id')->references('id')->on(config('badaso.database.prefix').'currencies')->onDelete('cascade');
            $table->foreign('account_type_id')->references('id')->on(config('badaso.database.prefix').'account_types')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');
            $table->foreign('account_group_id')->references('id')->on(config('badaso.database.prefix').'account_groups')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'accounts');
    }
}