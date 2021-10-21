<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRecurrent extends Model
{
    use HasFactory;

    protected $table = "calendar_recurrents" ;
    protected $fillable = [ "calendar_event_id", "name", "event_tz", "rrule", "rrule_type", "end_type", "interval", "count", "mo", "tu", "we", "th", "fr", "sa", "su", "month_by", "day", "byday", "until"] ;
}