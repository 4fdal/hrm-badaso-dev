<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('responsible_user_id')->nullable();
            $table->string("send_by")->nullable(); // phone, mail
            $table->double("automatic_email_time")->nullable();
            $table->boolean("is_recurrent_monday")->nullable();
            $table->boolean("is_recurrent_tuesday")->nullable();
            $table->boolean("is_recurrent_wednesday")->nullable();
            $table->boolean("is_recurrent_thursday")->nullable();
            $table->boolean("is_recurrent_friday")->nullable();
            $table->boolean("is_recurrent_saturday")->nullable();
            $table->boolean("is_recurrent_sunday")->nullable();
            $table->string("timezone")->nullable();
            $table->boolean("is_active")->nullable();
            $table->string("moment")->nullable(); // am, pm
            $table->string("delivery")->nullable(); // delivery, no_delivery

            $table->foreign('partner_id')->references('id')->on(config('badaso.database.prefix').'partners')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');
            $table->foreign('responsible_user_id')->references('id')->on(config('badaso.database.prefix').'users')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_vendors');
    }
}
