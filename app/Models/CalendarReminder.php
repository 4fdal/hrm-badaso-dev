<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarReminder extends Model
{
    use HasFactory;

    protected $table = "calendar_reminders" ;
    protected $fillable = [ "calendar_event_id", "calendar_alaram_id"] ;
}