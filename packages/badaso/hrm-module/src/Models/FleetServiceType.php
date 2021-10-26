<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetServiceType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "category"] ;

    public $public_data_rows = [['name','varchar'],['category','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'fleet_service_type_id', "references" => 'id', "on" => 'fleet_contract_services'],["foreign" => 'fleet_service_type_id', "references" => 'id', "on" => 'fleet_services'],["foreign" => 'vendor_parent_id', "references" => 'id', "on" => 'fleet_services']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_service_types';
        parent::__construct($attributes);
    }



    public function fleetServiceTypeFleetContractServices(){ return $this->hasMany(FleetContractService::class,"fleet_service_type_id"); }
    public function fleetServiceTypeFleetServices(){ return $this->hasMany(FleetService::class,"fleet_service_type_id"); }
    public function vendorParentFleetServices(){ return $this->hasMany(FleetService::class,"vendor_parent_id"); }

}