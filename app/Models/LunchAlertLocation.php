<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchAlertLocation extends Model
{
    use HasFactory;

    protected $table = "lunch_alert_locations" ;
    protected $fillable = [ "lunch_alert_id", "lunch_location_id"] ;
}