<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleTag extends Model
{
    use HasFactory;

    protected $table = "fleet_vehicle_tags" ;
    protected $fillable = [ "fleet_vehicle_id", "fleet_vehicle_categorie_id"] ;
}