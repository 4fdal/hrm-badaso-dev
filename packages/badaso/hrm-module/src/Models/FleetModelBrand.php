<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModelBrand extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name"] ;

    public $public_data_rows = [['name','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'fleet_model_brand_id', "references" => 'id', "on" => 'fleet_models', "model_on" => FleetModel::class],["foreign" => 'fleet_model_brand_id', "references" => 'id', "on" => 'fleet_vehicles', "model_on" => FleetVehicle::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_model_brands';
        parent::__construct($attributes);
    }



    public function fleetModelBrandFleetModels(){ return $this->hasMany(FleetModel::class, "fleet_model_brand_id"); }
    public function fleetModelBrandFleetVehicles(){ return $this->hasMany(FleetVehicle::class, "fleet_model_brand_id"); }

}