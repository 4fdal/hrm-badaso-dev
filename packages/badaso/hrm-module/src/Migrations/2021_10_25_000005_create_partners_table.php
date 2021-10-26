<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string("name")->nullable();
            $table->string("display_name")->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string("lang")->nullable();
            $table->string("timezone")->nullable();
            $table->string("vat")->nullable();
            $table->string("website")->nullable();
            $table->string("credit_limit")->nullable();
            $table->boolean("is_active")->nullable();
            $table->string("type")->nullable(); // private, contact,
            $table->string("street1")->nullable();
            $table->string("street2")->nullable();
            $table->string("zip")->nullable();
            $table->string("city")->nullable();
            $table->integer("state_id")->nullable();
            $table->integer("country_id")->nullable();
            $table->double("latitude")->nullable();
            $table->double("longitute")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("mobile")->nullable();
            $table->double("is_comapany")->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->unsignedBigInteger('commercial_partner_id')->nullable();
            $table->string("commercial_company_name")->nullable();
            $table->string("company_name")->nullable();

            $table->foreign('parent_id')->references('id')->on(config('badaso.database.prefix') . 'partners')->onDelete('cascade');
            $table->foreign('industry_id')->references('id')->on(config('badaso.database.prefix') . 'industries')->onDelete('cascade');
            $table->foreign('commercial_partner_id')->references('id')->on(config('badaso.database.prefix') . 'partners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix') . 'partners');
    }
}
