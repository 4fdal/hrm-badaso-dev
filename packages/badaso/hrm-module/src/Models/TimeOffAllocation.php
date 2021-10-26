<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffAllocation extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "time_off_type_id", "allocation_types", "number_of_day", "holiday_mode", "for_employee_id", "for_company_id", "for_departement_id", "for_employee_categorie_id", "description", "first_approve_employee_id", "second_approve_employee_id"] ;

    public $public_data_rows = [['name','varchar'],['time_off_type_id','int'],['allocation_types','enum'],['number_of_day','double'],['holiday_mode','enum'],['for_employee_id','int'],['for_company_id','int'],['for_departement_id','int'],['for_employee_categorie_id','int'],['description','text'],['first_approve_employee_id','int'],['second_approve_employee_id','int']] ;

    public $belongs_relation = [["foreign" => 'time_off_type_id', "references" => 'id', "on" => 'time_off_types'],["foreign" => 'for_employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'for_company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'for_departement_id', "references" => 'id', "on" => 'departements'],["foreign" => 'for_employee_categorie_id', "references" => 'id', "on" => 'employee_categories'],["foreign" => 'first_approve_employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'second_approve_employee_id', "references" => 'id', "on" => 'employees']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'time_off_allocations';
        parent::__construct($attributes);
    }

    public function timeOffType(){ return $this->belongsTo(TimeOffType::class); }
    public function forEmployee(){ return $this->belongsTo(Employee::class); }
    public function forCompany(){ return $this->belongsTo(Company::class); }
    public function forDepartement(){ return $this->belongsTo(Departement::class); }
    public function forEmployeeCategorie(){ return $this->belongsTo(EmployeeCategory::class); }
    public function firstApproveEmployee(){ return $this->belongsTo(Employee::class); }
    public function secondApproveEmployee(){ return $this->belongsTo(Employee::class); }



}