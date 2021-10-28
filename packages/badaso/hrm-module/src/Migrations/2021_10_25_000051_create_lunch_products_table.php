<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->unsignedBigInteger('lunch_product_category_id')->nullable();
            $table->string("description")->nullable();
            $table->double("price")->nullable();
            $table->unsignedBigInteger('lunch_vendor_id')->nullable();
            $table->boolean("is_active")->nullable();
            $table->integer("company_id")->nullable();
            $table->date("new_until")->nullable();

            $table->foreign('lunch_product_category_id')->references('id')->on(config('badaso.database.prefix').'lunch_product_categories')->onDelete('cascade');
            $table->foreign('lunch_vendor_id')->references('id')->on(config('badaso.database.prefix').'lunch_vendors')->onDelete('cascade');

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
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_products');
    }
}
