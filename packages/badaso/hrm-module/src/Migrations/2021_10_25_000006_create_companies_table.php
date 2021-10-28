<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'companies', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->integer("sequnce")->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->string("report_header")->nullable();
            $table->string("report_footer")->nullable();
            $table->string("img_logo_path")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();

            $table->foreign('currency_id')->references('id')->on(config('badaso.database.prefix') . 'currencies')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on(config('badaso.database.prefix') . 'companies')->onDelete('cascade');
            $table->foreign('partner_id')->references('id')->on(config('badaso.database.prefix') . 'partners')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table(config('badaso.database.prefix') . 'partners', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix') . 'companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix') . 'companies');
    }
}
