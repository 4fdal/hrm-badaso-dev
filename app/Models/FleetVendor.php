<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVendor extends Model
{
    use HasFactory;

    protected $table = "fleet_vendors" ;
    protected $fillable = [ "fleet_model_id", "partner_id"] ;
}