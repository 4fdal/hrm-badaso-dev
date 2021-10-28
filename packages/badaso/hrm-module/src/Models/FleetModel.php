<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModel extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "fleet_model_brand_id", "manager_user_id", "is_active", "vehicle_type"] ;

    public $public_data_rows = [['name','varchar'],['fleet_model_brand_id','int'],['manager_user_id','int'],['is_active','boolean'],['vehicle_type','enum']] ;

    public $belongs_relation = [["foreign" => 'fleet_model_brand_id', "references" => 'id', "on" => 'fleet_model_brands', "model_on" => FleetModelBrand::class],["foreign" => 'manager_user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class]] ;

    public $many_relation = [["foreign" => 'fleet_model_id', "references" => 'id', "on" => 'fleet_vendors', "model_on" => FleetVendor::class],["foreign" => 'fleet_model_id', "references" => 'id', "on" => 'fleet_vehicles', "model_on" => FleetVehicle::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_models';
        parent::__construct($attributes);
    }

    public function fleetModelBrand(){ return $this->belongsTo(FleetModelBrand::class, "fleet_model_brand_id"); }
    public function managerUser(){ return $this->belongsTo(BadasoUser::class, "manager_user_id"); }


    public function fleetModelFleetVendors(){ return $this->hasMany(FleetVendor::class, "fleet_model_id"); }
    public function fleetModelFleetVehicles(){ return $this->hasMany(FleetVehicle::class, "fleet_model_id"); }

}