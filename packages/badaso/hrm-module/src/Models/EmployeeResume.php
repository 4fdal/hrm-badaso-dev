<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeResume extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "employee_id", "resume_line_type_id", "display_type", "start", "end", "description"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function employee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function resumeLineType(){ return $this->belongsTo(Uasoft\Badaso\Models\ResumeLineType::class); }

}