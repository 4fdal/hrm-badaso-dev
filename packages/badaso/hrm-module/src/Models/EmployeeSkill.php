<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "skill_type_id", "skill_id", "skill_level_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function skillType(){ return $this->belongsTo(Uasoft\Badaso\Models\SkillType::class); }
    public function skill(){ return $this->belongsTo(Uasoft\Badaso\Models\Skill::class); }
    public function skillLevel(){ return $this->belongsTo(Uasoft\Badaso\Models\SkillLevel::class); }

}