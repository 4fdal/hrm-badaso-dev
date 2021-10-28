<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContract extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "responsible_user_id", "fleet_contract_type_id", "vendor_parent_id", "reference", "activation_cost", "recurring_cost", "recurring_cost_frequency", "fleet_vehicle_id", "invoice_date", "contract_start_date", "contract_expiration_date", "terms_conditions"] ;

    public $public_data_rows = [['responsible_user_id','int'],['fleet_contract_type_id','int'],['vendor_parent_id','int'],['reference','varchar'],['activation_cost','double'],['recurring_cost','double'],['recurring_cost_frequency','enum'],['fleet_vehicle_id','int'],['invoice_date','date'],['contract_start_date','date'],['contract_expiration_date','date'],['terms_conditions','text']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'fleet_contract_id', "references" => 'id', "on" => 'fleet_contract_services', "model_on" => FleetContractService::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_contracts';
        parent::__construct($attributes);
    }



    public function fleetContractFleetContractServices(){ return $this->hasMany(FleetContractService::class, "fleet_contract_id"); }

}