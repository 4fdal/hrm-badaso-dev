<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    use HasFactory;

    protected $table = "skill_levels" ;
    protected $fillable = [ "skill_type_id", "name", "level_progress"] ;
}