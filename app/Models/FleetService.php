<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetService extends Model
{
    use HasFactory;

    protected $table = "fleet_services" ;
    protected $fillable = [ "description", "fleet_service_type_id", "date", "cost", "vendor_parent_id", "fleet_vehicle_id", "driver_partner_id", "odometer_value", "notes"] ;
}