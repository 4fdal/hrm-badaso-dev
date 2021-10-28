<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'account_types', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->boolean("include_initial_balence")->nullable(); 
            $table->string("type")->nullable(); // receivable, payable, liquidity, other, 
            $table->string("internal_group")->nullable(); // asset, liability, asset, equity 
            $table->string("note")->nullable(); 

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
        Schema::dropIfExists(config('badaso.database.prefix').'account_types');
    }
}