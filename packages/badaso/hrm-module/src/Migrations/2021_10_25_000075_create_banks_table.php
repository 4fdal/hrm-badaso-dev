<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'banks', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("street1")->nullable();
            $table->string("street2")->nullable();
            $table->string("zip")->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->boolean("is_active")->nullable();
            $table->string("bic")->nullable();

            $table->foreign('state_id')->references('id')->on(config('badaso.database.prefix').'states')->onDelete('cascade');
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
        Schema::dropIfExists(config('badaso.database.prefix').'banks');
    }
}
