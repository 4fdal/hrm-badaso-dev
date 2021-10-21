<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModel extends Model
{
    use HasFactory;

    protected $table = "fleet_models" ;
    protected $fillable = [ "name", "fleet_model_brand_id", "manager_user_id", "is_active", "vehicle_type"] ;
}