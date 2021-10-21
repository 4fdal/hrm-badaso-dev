<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategoryTopping extends Model
{
    use HasFactory;

    protected $table = "lunch_product_category_toppings" ;
    protected $fillable = [ "lunch_product_category_id", "name"] ;
}