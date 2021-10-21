<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    use HasFactory;

    protected $table = "employee_skills" ;
    protected $fillable = [ "skill_type_id", "skill_id", "skill_level_id"] ;
}