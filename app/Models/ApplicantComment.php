<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantComment extends Model
{
    use HasFactory;

    protected $table = "applicant_comments" ;
    protected $fillable = [ "applicant_id", "user_id", "message", "attachments"] ;
}