<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'partner_banks', function (Blueprint $table) {
            $table->id();
            $table->boolean("is_active")->nullable(); 
            $table->string("acc_number")->nullable(); 
            $table->string("sanitize_acc_number")->nullable(); 
            $table->string("acc_holder_name")->nullable(); 
            $table->unsignedBigInteger('partner_id')->nullable(); 
            $table->unsignedBigInteger('bank_id')->nullable(); 
            $table->integer("sequnce")->nullable(); 
            $table->unsignedBigInteger('currency_id')->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 

            $table->foreign('partner_id')->references('id')->on(config('badaso.database.prefix').'partners')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on(config('badaso.database.prefix').'banks')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on(config('badaso.database.prefix').'currencies')->onDelete('cascade');
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
        Schema::dropIfExists(config('badaso.database.prefix').'partner_banks');
    }
}