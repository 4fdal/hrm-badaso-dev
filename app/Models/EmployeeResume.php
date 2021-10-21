<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResume extends Model
{
    use HasFactory;

    protected $table = "employee_resumes" ;
    protected $fillable = [ "employee_id", "resume_line_type_id", "display_type", "start", "end", "description"] ;
}