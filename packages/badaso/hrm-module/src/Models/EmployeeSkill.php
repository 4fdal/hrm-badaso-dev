<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSkill extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "skill_type_id", "skill_id", "skill_level_id"] ;

    public $public_data_rows = [['skill_type_id','int'],['skill_id','int'],['skill_level_id','int']] ;

    public $belongs_relation = [["foreign" => 'skill_type_id', "references" => 'id', "on" => 'skill_types'],["foreign" => 'skill_id', "references" => 'id', "on" => 'skills'],["foreign" => 'skill_level_id', "references" => 'id', "on" => 'skill_levels']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employee_skills';
        parent::__construct($attributes);
    }

    public function skillType(){ return $this->belongsTo(SkillType::class); }
    public function skill(){ return $this->belongsTo(Skill::class); }
    public function skillLevel(){ return $this->belongsTo(SkillLevel::class); }



}