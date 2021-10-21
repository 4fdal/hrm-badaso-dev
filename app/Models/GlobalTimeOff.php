<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalTimeOff extends Model
{
    use HasFactory;

    protected $table = "global_time_offs" ;
    protected $fillable = [ "worke_id", "reason", "start_date", "end_date"] ;
}