<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "employee_id", "check_in", "check_out", "worked_hours"] ;

    public $public_data_rows = [['employee_id','int'],['check_in','datetime'],['check_out','datetime'],['worked_hours','double']] ;

    public $belongs_relation = [["foreign" => 'employee_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employee_attendances';
        parent::__construct($attributes);
    }

    public function employee(){ return $this->belongsTo(Employee::class, "employee_id"); }



}