<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventCategory extends Model
{
    use HasFactory;

    protected $table = "calendar_event_categories" ;
    protected $fillable = [ "name"] ;
}