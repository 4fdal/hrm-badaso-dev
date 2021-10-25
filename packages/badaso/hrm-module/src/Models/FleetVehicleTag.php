<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_vehicle_id", "fleet_vehicle_categorie_id"] ;

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
    public function fleetVehicleCategorie(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetVehicleCategory::class); }

}