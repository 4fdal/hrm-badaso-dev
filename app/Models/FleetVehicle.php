<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicle extends Model
{
    use HasFactory;

    protected $table = "fleet_vehicles" ;
    protected $fillable = [ "fleet_model_id", "fleet_model_brand_id", "name", "is_active", "vin_sn", "description", "license_plate", "fleet_state_id", "driver_partner_id", "future_driver_partner_id", "is_plan_change_card", "assignment_date", "localtion", "manager_user_id", "first_contract_date", "last_odometer", "unit_odometer", "immatriculation_date", "chassis_number", "catalog_value", "purchase_value", "residual_value", "company_id", "seats_number", "doors_number", "color", "model_year", "transmission", "fuel_type", "c02_emission", "horsepower", "horsepower_taxation", "power"] ;
}