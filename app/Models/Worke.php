<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worke extends Model
{
    use HasFactory;

    protected $table = "workes" ;
    protected $fillable = [ "company_id", "average_hours_per_day", "timezone"] ;
}