<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetService extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "description", "fleet_service_type_id", "date", "cost", "vendor_parent_id", "fleet_vehicle_id", "driver_partner_id", "odometer_value", "notes"] ;

    public $public_data_rows = [['description','text'],['fleet_service_type_id','int'],['date','date'],['cost','double'],['vendor_parent_id','int'],['fleet_vehicle_id','int'],['driver_partner_id','int'],['odometer_value','double'],['notes','text']] ;

    public $belongs_relation = [["foreign" => 'fleet_service_type_id', "references" => 'id', "on" => 'fleet_service_types'],["foreign" => 'vendor_parent_id', "references" => 'id', "on" => 'fleet_service_types'],["foreign" => 'fleet_vehicle_id', "references" => 'id', "on" => 'fleet_vehicles'],["foreign" => 'driver_partner_id', "references" => 'id', "on" => 'partners']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_services';
        parent::__construct($attributes);
    }

    public function fleetServiceType(){ return $this->belongsTo(FleetServiceType::class); }
    public function vendorParent(){ return $this->belongsTo(FleetServiceType::class); }
    public function fleetVehicle(){ return $this->belongsTo(FleetVehicle::class); }
    public function driverPartner(){ return $this->belongsTo(Partner::class); }



}