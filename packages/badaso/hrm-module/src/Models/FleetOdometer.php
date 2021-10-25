<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetOdometer extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "date", "value", "fleet_vehicle_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetVehicle(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetVehicle::class); }

}