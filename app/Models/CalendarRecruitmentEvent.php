<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRecruitmentEvent extends Model
{
    use HasFactory;

    protected $table = "calendar_recruitment_events" ;
    protected $fillable = [ "done_status", "calendar_event_id"] ;
}