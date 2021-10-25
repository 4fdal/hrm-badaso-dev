<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicle extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_model_id", "fleet_model_brand_id", "name", "is_active", "vin_sn", "description", "license_plate", "fleet_state_id", "driver_partner_id", "future_driver_partner_id", "is_plan_change_card", "assignment_date", "localtion", "manager_user_id", "first_contract_date", "last_odometer", "unit_odometer", "immatriculation_date", "chassis_number", "catalog_value", "purchase_value", "residual_value", "company_id", "seats_number", "doors_number", "color", "model_year", "transmission", "fuel_type", "c02_emission", "horsepower", "horsepower_taxation", "power"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetModel(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetModel::class); }
    public function fleetModelBrand(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetModelBrand::class); }
    public function fleetState(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetState::class); }
    public function driverPartner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }
    public function futureDriverPartner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }
    public function managerUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}