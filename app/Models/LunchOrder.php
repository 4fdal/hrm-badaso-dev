<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrder extends Model
{
    use HasFactory;

    protected $table = "lunch_orders" ;
    protected $fillable = [ "lunch_product_id", "lunch_product_category_id", "date", "lunch_vendor_id", "user_id", "note", "price", "is_active", "state", "company_id", "currency_id", "quantity", "display_topping"] ;
}