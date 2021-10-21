<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = "recruitments" ;
    protected $fillable = [ "job_id", "is_favorite", "no_of_application", "no_of_to_recruit", "no_of_new_application", "color"] ;
}