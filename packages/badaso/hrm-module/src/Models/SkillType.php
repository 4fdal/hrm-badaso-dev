<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name"] ;

    public $public_data_rows = [['name','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'skill_type_id', "references" => 'id', "on" => 'skill_levels', "model_on" => SkillLevel::class],["foreign" => 'skill_type_id', "references" => 'id', "on" => 'skills', "model_on" => Skill::class],["foreign" => 'skill_type_id', "references" => 'id', "on" => 'employee_skills', "model_on" => EmployeeSkill::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'skill_types';
        parent::__construct($attributes);
    }



    public function skillTypeSkillLevels(){ return $this->hasMany(SkillLevel::class, "skill_type_id"); }
    public function skillTypeSkills(){ return $this->hasMany(Skill::class, "skill_type_id"); }
    public function skillTypeEmployeeSkills(){ return $this->hasMany(EmployeeSkill::class, "skill_type_id"); }

}