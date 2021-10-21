<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetOdometer extends Model
{
    use HasFactory;

    protected $table = "fleet_odometers" ;
    protected $fillable = [ "name", "date", "value", "fleet_vehicle_id"] ;
}