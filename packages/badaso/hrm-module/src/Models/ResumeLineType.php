<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeLineType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "sequnce"] ;

    public $public_data_rows = [['name','varchar'],['sequnce','int']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'resume_line_type_id', "references" => 'id', "on" => 'employee_resumes']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'resume_line_types';
        parent::__construct($attributes);
    }



    public function resumeLineTypeEmployeeResumes(){ return $this->hasMany(EmployeeResume::class, "resume_line_type_id"); }

}