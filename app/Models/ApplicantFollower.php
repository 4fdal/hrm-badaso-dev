<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantFollower extends Model
{
    use HasFactory;

    protected $table = "applicant_followers" ;
    protected $fillable = [ "applicant_id", "user_id"] ;
}