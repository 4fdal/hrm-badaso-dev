<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCategory extends Model
{
    use HasFactory;

    protected $table = "applicant_categories" ;
    protected $fillable = [ "name", "color"] ;
}