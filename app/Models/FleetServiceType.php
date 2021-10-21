<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetServiceType extends Model
{
    use HasFactory;

    protected $table = "fleet_service_types" ;
    protected $fillable = [ "name", "category"] ;
}