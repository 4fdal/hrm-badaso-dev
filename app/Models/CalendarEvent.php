<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = "calendar_events" ;
    protected $fillable = [ "name", "start", "stop", "is_all_day", "duration", "description", "privacy", "localtion", "user_id", "is_active", "is_recurrent", "show_as"] ;
}