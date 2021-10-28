<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLunchProductCategoryToppingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('badaso.database.prefix') . 'lunch_product_category_topping_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lunch_product_category_topping_id')->nullable();
            $table->string("name")->nullable();
            $table->double("price")->nullable();

            $table->foreign('lunch_product_category_topping_id', 'lpcti_ref_lunch_product_category_topping_id')->references('id')->on(config('badaso.database.prefix') . 'lunch_product_category_toppings')->onDelete('cascade');
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
        Schema::dropIfExists(config('badaso.database.prefix') . 'lunch_product_category_topping_items');
    }
}
