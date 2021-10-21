<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarAlaram extends Model
{
    use HasFactory;

    protected $table = "calendar_alarams" ;
    protected $fillable = [ "name", "alaram_type", "duration", "interval"] ;
}