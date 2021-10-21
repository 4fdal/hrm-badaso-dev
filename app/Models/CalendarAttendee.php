<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarAttendee extends Model
{
    use HasFactory;

    protected $table = "calendar_attendees" ;
    protected $fillable = [ "common_name", "calendar_event_id", "partner_id"] ;
}