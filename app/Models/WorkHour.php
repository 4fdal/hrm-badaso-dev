<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    protected $table = "work_hours" ;
    protected $fillable = [ "work_id", "name", "day_of_week", "day_period", "work_from", "work_to", "start_date", "end_date"] ;
}