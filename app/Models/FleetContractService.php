<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContractService extends Model
{
    use HasFactory;

    protected $table = "fleet_contract_services" ;
    protected $fillable = [ "fleet_contract_id", "fleet_service_type_id"] ;
}