<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchCashmove extends Model
{
    use HasFactory;

    protected $table = "lunch_cashmoves" ;
    protected $fillable = [ "currency_id", "user_id", "date", "amount", "description"] ;
}