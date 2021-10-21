<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeLineType extends Model
{
    use HasFactory;

    protected $table = "resume_line_types" ;
    protected $fillable = [ "name", "sequnce"] ;
}