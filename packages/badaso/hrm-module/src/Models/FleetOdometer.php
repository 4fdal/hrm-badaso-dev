<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetOdometer extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "date", "value", "fleet_vehicle_id"] ;

    public $public_data_rows = [['name','varchar'],['date',''],['value','double'],['fleet_vehicle_id','int']] ;

    public $belongs_relation = [["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_vehicles']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_odometers';
        parent::__construct($attributes);
    }

    public function fleetVehicle(){ return $this->belongsTo(FleetVehicle::class); }



}