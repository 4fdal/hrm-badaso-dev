<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContractService extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_contract_id", "fleet_service_type_id"] ;

    public $public_data_rows = [['fleet_contract_id','int'],['fleet_service_type_id','int']] ;

    public $belongs_relation = [["foreign" => 'fleet_contract_id', "references" => 'id', "on" => 'fleet_contracts'],["foreign" => 'fleet_service_type_id', "references" => 'id', "on" => 'fleet_service_types']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_contract_services';
        parent::__construct($attributes);
    }

    public function fleetContract(){ return $this->belongsTo(FleetContract::class, "fleet_contract_id"); }
    public function fleetServiceType(){ return $this->belongsTo(FleetServiceType::class, "fleet_service_type_id"); }



}