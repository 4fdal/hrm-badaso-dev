<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix').'lunch_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_product_id')->nullable(); 
            $table->unsignedBigInteger('lunch_product_category_id')->nullable(); 
            $table->date("date")->nullable(); 
            $table->unsignedBigInteger('lunch_vendor_id')->nullable(); 
            $table->integer("user_id")->nullable(); 
            $table->string("note")->nullable(); 
            $table->double("price")->nullable(); 
            $table->boolean("is_active")->nullable(); 
            $table->string("state")->nullable(); 
            $table->unsignedBigInteger('company_id')->nullable(); 
            $table->unsignedBigInteger('currency_id')->nullable(); 
            $table->integer("quantity")->nullable(); 
            $table->string("display_topping")->nullable(); 

            $table->foreign('lunch_product_id')->references('id')->on(config('badaso.database.prefix').'lunch_products')->onDelete('cascade');
            $table->foreign('lunch_product_category_id')->references('id')->on(config('badaso.database.prefix').'lunch_product_categories')->onDelete('cascade');
            $table->foreign('lunch_vendor_id')->references('id')->on(config('badaso.database.prefix').'lunch_products')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on(config('badaso.database.prefix').'companies')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on(config('badaso.database.prefix').'currencies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('badaso.database.prefix').'lunch_orders');
    }
}