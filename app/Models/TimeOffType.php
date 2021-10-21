<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffType extends Model
{
    use HasFactory;

    protected $table = "time_off_types" ;
    protected $fillable = [ "is_create_calendar", "is_active", "color", "company_id", "name", "payroll_code", "take_time_off_types", "responsible_user_id", "allocation_types", "allocation_validation_types", "validity_start", "validity_stop", "time_off_validation_types"] ;
}