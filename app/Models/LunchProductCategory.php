<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategory extends Model
{
    use HasFactory;

    protected $table = "lunch_product_categories" ;
    protected $fillable = [ "name", "company_id", "is_active"] ;
}