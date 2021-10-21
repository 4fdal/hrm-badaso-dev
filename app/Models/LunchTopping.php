<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchTopping extends Model
{
    use HasFactory;

    protected $table = "lunch_toppings" ;
    protected $fillable = [ "name", "company_id", "price", "lunch_product_category_topping_id"] ;
}