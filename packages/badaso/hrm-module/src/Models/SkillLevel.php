<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillLevel extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "skill_type_id", "name", "level_progress"] ;

    public $public_data_rows = [['skill_type_id','int'],['name','varchar'],['level_progress','double']] ;

    public $belongs_relation = [["foreign" => 'skill_type_id', "references" => 'id', "on" => 'skill_types', "model_on" => SkillType::class]] ;

    public $many_relation = [["foreign" => 'skill_level_id', "references" => 'id', "on" => 'employee_skills', "model_on" => EmployeeSkill::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'skill_levels';
        parent::__construct($attributes);
    }

    public function skillType(){ return $this->belongsTo(SkillType::class, "skill_type_id"); }


    public function skillLevelEmployeeSkills(){ return $this->hasMany(EmployeeSkill::class, "skill_level_id"); }

}