<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContractService extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_contract_id", "fleet_service_type_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetContract(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetContract::class); }
    public function fleetServiceType(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetServiceType::class); }

}