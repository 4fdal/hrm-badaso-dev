<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
{
    use HasFactory;

    protected $table = "time_offs" ;
    protected $fillable = [ "private_name", "status", "user_id", "manager_employee_id", "time_off_type_id", "employee_id", "departement_id", "notes", "date_from", "date_to", "number_of_day", "duration_display", "metting_calendar_event_id"] ;
}