<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicle extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_model_id", "fleet_model_brand_id", "name", "is_active", "vin_sn", "description", "license_plate", "fleet_state_id", "driver_partner_id", "future_driver_partner_id", "is_plan_change_card", "assignment_date", "localtion", "manager_user_id", "first_contract_date", "last_odometer", "unit_odometer", "immatriculation_date", "chassis_number", "catalog_value", "purchase_value", "residual_value", "company_id", "seats_number", "doors_number", "color", "model_year", "transmission", "fuel_type", "c02_emission", "horsepower", "horsepower_taxation", "power"] ;

    public $public_data_rows = [['fleet_model_id','int'],['fleet_model_brand_id','int'],['name','varchar'],['is_active','boolean'],['vin_sn','varchar'],['description','varchar'],['license_plate','varchar'],['fleet_state_id','int'],['driver_partner_id','int'],['future_driver_partner_id','int'],['is_plan_change_card','boolean'],['assignment_date','date'],['localtion','varchar'],['manager_user_id','int'],['first_contract_date','date'],['last_odometer','double'],['unit_odometer','varchar'],['immatriculation_date','date'],['chassis_number','varchar'],['catalog_value','double'],['purchase_value','double'],['residual_value','double'],['company_id','int'],['seats_number','varchar'],['doors_number','varchar'],['color','varchar'],['model_year','year'],['transmission','enum'],['fuel_type','enum'],['c02_emission','double'],['horsepower','double'],['horsepower_taxation','double'],['power','double']] ;

    public $belongs_relation = [["foreign" => 'fleet_model_id', "references" => 'id', "on" => 'fleet_models', "model_on" => FleetModel::class],["foreign" => 'fleet_model_brand_id', "references" => 'id', "on" => 'fleet_model_brands', "model_on" => FleetModelBrand::class],["foreign" => 'fleet_state_id', "references" => 'id', "on" => 'fleet_states', "model_on" => FleetState::class],["foreign" => 'driver_partner_id', "references" => 'id', "on" => 'partners', "model_on" => Partner::class],["foreign" => 'future_driver_partner_id', "references" => 'id', "on" => 'partners', "model_on" => Partner::class],["foreign" => 'manager_user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class],["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class]] ;

    public $many_relation = [["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_vehicle_tags', "model_on" => FleetVehicleTag::class],["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_services', "model_on" => FleetService::class],["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_odometers', "model_on" => FleetOdometer::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_vehicles';
        parent::__construct($attributes);
    }

    public function fleetModel(){ return $this->belongsTo(FleetModel::class, "fleet_model_id"); }
    public function fleetModelBrand(){ return $this->belongsTo(FleetModelBrand::class, "fleet_model_brand_id"); }
    public function fleetState(){ return $this->belongsTo(FleetState::class, "fleet_state_id"); }
    public function driverPartner(){ return $this->belongsTo(Partner::class, "driver_partner_id"); }
    public function futureDriverPartner(){ return $this->belongsTo(Partner::class, "future_driver_partner_id"); }
    public function managerUser(){ return $this->belongsTo(BadasoUser::class, "manager_user_id"); }
    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function fleetVehicleFleetVehicleTags(){ return $this->hasMany(FleetVehicleTag::class, "fleet_vehicle_id"); }
    public function fleetVehicleFleetServices(){ return $this->hasMany(FleetService::class, "fleet_vehicle_id"); }
    public function fleetVehicleFleetOdometers(){ return $this->hasMany(FleetOdometer::class, "fleet_vehicle_id"); }

}