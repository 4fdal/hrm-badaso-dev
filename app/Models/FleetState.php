<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetState extends Model
{
    use HasFactory;

    protected $table = "fleet_states" ;
    protected $fillable = [ "name", "sequnce"] ;
}