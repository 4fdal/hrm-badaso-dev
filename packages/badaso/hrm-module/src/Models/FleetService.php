<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetService extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "description", "fleet_service_type_id", "date", "cost", "vendor_parent_id", "fleet_vehicle_id", "driver_partner_id", "odometer_value", "notes"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetServiceType(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetServiceType::class); }
    public function vendorParent(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetServiceType::class); }
    public function fleetVehicle(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetVehicle::class); }
    public function driverPartner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }

}