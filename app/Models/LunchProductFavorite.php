<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductFavorite extends Model
{
    use HasFactory;

    protected $table = "lunch_product_favorites" ;
    protected $fillable = [ "lunch_product_id", "user_id"] ;
}