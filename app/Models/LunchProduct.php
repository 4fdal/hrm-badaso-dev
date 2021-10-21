<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProduct extends Model
{
    use HasFactory;

    protected $table = "lunch_products" ;
    protected $fillable = [ "name", "lunch_product_category_id", "description", "price", "lunch_vendor_id", "is_active", "company_id", "new_until"] ;
}