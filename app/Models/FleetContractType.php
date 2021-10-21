<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContractType extends Model
{
    use HasFactory;

    protected $table = "fleet_contract_types" ;
    protected $fillable = [ "name", "category"] ;
}