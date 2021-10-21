<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrderTopping extends Model
{
    use HasFactory;

    protected $table = "lunch_order_toppings" ;
    protected $fillable = [ "lunch_order_id", "lunch_topping_id"] ;
}