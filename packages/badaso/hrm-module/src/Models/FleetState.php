<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetState extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "sequnce"] ;

    public $public_data_rows = [['name','varchar'],['sequnce','int']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'fleet_state_id', "references" => 'id', "on" => 'fleet_vehicles']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_states';
        parent::__construct($attributes);
    }



    public function fleetStateFleetVehicles(){ return $this->hasMany(FleetVehicle::class,"fleet_state_id"); }

}