<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleCategory extends Model
{
    use HasFactory;

    protected $table = "fleet_vehicle_categories" ;
    protected $fillable = [ "name", "color", "user_id"] ;
}