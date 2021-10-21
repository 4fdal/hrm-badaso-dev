<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchLocation extends Model
{
    use HasFactory;

    protected $table = "lunch_locations" ;
    protected $fillable = [ "name", "address", "company_id"] ;
}