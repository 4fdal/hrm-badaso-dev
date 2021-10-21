<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventTag extends Model
{
    use HasFactory;

    protected $table = "calendar_event_tags" ;
    protected $fillable = [ "calendar_event_id", "calendar_event_category_id"] ;
}