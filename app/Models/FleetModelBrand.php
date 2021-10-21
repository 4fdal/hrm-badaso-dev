<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModelBrand extends Model
{
    use HasFactory;

    protected $table = "fleet_model_brands" ;
    protected $fillable = [ "name"] ;
}