<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategoryToppingItem extends Model
{
    use HasFactory;

    protected $table = "lunch_product_category_topping_items" ;
    protected $fillable = [ "lunch_product_category_topping_id", "name", "price"] ;
}