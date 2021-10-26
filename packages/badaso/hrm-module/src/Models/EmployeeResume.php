<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResume extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "employee_id", "resume_line_type_id", "display_type", "start", "end", "description"] ;

    public $public_data_rows = [['employee_id','int'],['resume_line_type_id','int'],['display_type','enum'],['start','date'],['end','date'],['description','text']] ;

    public $belongs_relation = [["foreign" => 'employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'resume_line_type_id', "references" => 'id', "on" => 'resume_line_types']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employee_resumes';
        parent::__construct($attributes);
    }

    public function employee(){ return $this->belongsTo(Employee::class, "employee_id"); }
    public function resumeLineType(){ return $this->belongsTo(ResumeLineType::class, "resume_line_type_id"); }



}