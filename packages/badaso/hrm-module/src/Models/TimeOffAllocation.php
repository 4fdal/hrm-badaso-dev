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

    public $belongs_relation = [["foreign" => 'time_off_type_id', "references" => 'id', "on" => 'time_off_types', "model_on" => TimeOffType::class],["foreign" => 'for_employee_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class],["foreign" => 'for_company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class],["foreign" => 'for_departement_id', "references" => 'id', "on" => 'departements', "model_on" => Departement::class],["foreign" => 'for_employee_categorie_id', "references" => 'id', "on" => 'employee_categories', "model_on" => EmployeeCategory::class],["foreign" => 'first_approve_employee_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class],["foreign" => 'second_approve_employee_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class]] ;

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

    public function timeOffType(){ return $this->belongsTo(TimeOffType::class, "time_off_type_id"); }
    public function forEmployee(){ return $this->belongsTo(Employee::class, "for_employee_id"); }
    public function forCompany(){ return $this->belongsTo(Company::class, "for_company_id"); }
    public function forDepartement(){ return $this->belongsTo(Departement::class, "for_departement_id"); }
    public function forEmployeeCategorie(){ return $this->belongsTo(EmployeeCategory::class, "for_employee_categorie_id"); }
    public function firstApproveEmployee(){ return $this->belongsTo(Employee::class, "first_approve_employee_id"); }
    public function secondApproveEmployee(){ return $this->belongsTo(Employee::class, "second_approve_employee_id"); }



}