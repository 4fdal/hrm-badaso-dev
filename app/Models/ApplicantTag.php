<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTag extends Model
{
    use HasFactory;

    protected $table = "applicant_tags" ;
    protected $fillable = [ "applicant_id", "applicant_category_id"] ;
}