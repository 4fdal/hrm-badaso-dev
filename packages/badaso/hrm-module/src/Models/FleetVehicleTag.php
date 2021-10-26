<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_vehicle_id", "fleet_vehicle_categorie_id"] ;

    public $public_data_rows = [['fleet_vehicle_id','int'],['fleet_vehicle_categorie_id','int']] ;

    public $belongs_relation = [["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_vehicles'],["foreign" => 'fleet_vehicle_categorie_id', "references" => 'id', "on" => 'fleet_vehicle_categories']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_vehicle_tags';
        parent::__construct($attributes);
    }

    public function fleetVehicle(){ return $this->belongsTo(FleetVehicle::class); }
    public function fleetVehicleCategorie(){ return $this->belongsTo(FleetVehicleCategory::class); }



}