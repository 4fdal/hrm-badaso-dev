<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "user_id", "name", "job_postion_name", "work_mobile", "work_phone", "work_email", "departement_id", "company_id", "coach_id", "is_active", "work_address_id", "work_location", "approve_time_off_user_id", "approve_expenses_user_id", "work_id", "tz", "address_id", "email", "phone", "home_work_distance", "marital_status", "emergency_contanct", "emergency_phone", "certificate_level_id", "field_of_study", "school", "country_id", "identification_no", "pasport_no", "gender", "data_of_birth", "place_of_birth", "country_of_birth_id", "no_of_children", "visa_no", "work_permit_no", "visa_expire_data", "job_id", "mobility_card", "pin_code", "id_badge"] ;

    public $public_data_rows = [['user_id','int'],['name','varchar'],['job_postion_name','varchar'],['work_mobile','varchar'],['work_phone','varchar'],['work_email','varchar'],['departement_id','int'],['company_id','int'],['coach_id','int'],['is_active','boolean'],['work_address_id','int'],['work_location','varchar'],['approve_time_off_user_id','int'],['approve_expenses_user_id','int'],['work_id','int'],['tz','varchar'],['address_id','int'],['email','varchar'],['phone','varchar'],['home_work_distance','double'],['marital_status','enum'],['emergency_contanct','varchar'],['emergency_phone','varchar'],['certificate_level_id','varchar'],['field_of_study','varchar'],['school','varchar'],['country_id','int'],['identification_no','varchar'],['pasport_no','varchar'],['gender','enum'],['data_of_birth','varchar'],['place_of_birth','varchar'],['country_of_birth_id','int'],['no_of_children','int'],['visa_no','varchar'],['work_permit_no','varchar'],['visa_expire_data','date'],['job_id','int'],['mobility_card','varchar'],['pin_code','varchar'],['id_badge','varchar']] ;

    public $belongs_relation = [["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users'],["foreign" => 'approve_time_off_user_id', "references" => 'id', "on" => 'badaso_users'],["foreign" => 'approve_expenses_user_id', "references" => 'id', "on" => 'badaso_users'],["foreign" => 'work_id', "references" => 'id', "on" => 'workes'],["foreign" => 'certificate_level_id', "references" => 'id', "on" => 'degrees'],["foreign" => 'country_id', "references" => 'id', "on" => 'countries'],["foreign" => 'country_of_birth_id', "references" => 'id', "on" => 'countries']] ;

    public $many_relation = [["foreign" => 'employee_id', "references" => 'id', "on" => 'employee_tags'],["foreign" => 'employee_id', "references" => 'id', "on" => 'employee_resumes'],["foreign" => 'employee_id', "references" => 'id', "on" => 'employee_attendances'],["foreign" => 'manager_id', "references" => 'id', "on" => 'departements'],["foreign" => 'manager_id', "references" => 'id', "on" => 'jobs'],["foreign" => 'for_employee_id', "references" => 'id', "on" => 'time_off_allocations'],["foreign" => 'first_approve_employee_id', "references" => 'id', "on" => 'time_off_allocations'],["foreign" => 'second_approve_employee_id', "references" => 'id', "on" => 'time_off_allocations'],["foreign" => 'manager_employee_id', "references" => 'id', "on" => 'time_offs'],["foreign" => 'employee_id', "references" => 'id', "on" => 'time_offs'],["foreign" => 'employee_id', "references" => 'id', "on" => 'expense_reports']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employees';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(BadasoUser::class); }
    public function approveTimeOffUser(){ return $this->belongsTo(BadasoUser::class); }
    public function approveExpensesUser(){ return $this->belongsTo(BadasoUser::class); }
    public function work(){ return $this->belongsTo(Worke::class); }
    public function certificateLevel(){ return $this->belongsTo(Degree::class); }
    public function country(){ return $this->belongsTo(Country::class); }
    public function countryOfBirth(){ return $this->belongsTo(Country::class); }


    public function employeeEmployeeTags(){ return $this->hasMany(EmployeeTag::class,"employee_id"); }
    public function employeeEmployeeResumes(){ return $this->hasMany(EmployeeResume::class,"employee_id"); }
    public function employeeEmployeeAttendances(){ return $this->hasMany(EmployeeAttendance::class,"employee_id"); }
    public function managerDepartements(){ return $this->hasMany(Departement::class,"manager_id"); }
    public function managerJobs(){ return $this->hasMany(Job::class,"manager_id"); }
    public function forEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class,"for_employee_id"); }
    public function firstApproveEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class,"first_approve_employee_id"); }
    public function secondApproveEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class,"second_approve_employee_id"); }
    public function managerEmployeeTimeOffs(){ return $this->hasMany(TimeOff::class,"manager_employee_id"); }
    public function employeeTimeOffs(){ return $this->hasMany(TimeOff::class,"employee_id"); }
    public function employeeExpenseReports(){ return $this->hasMany(ExpenseReport::class,"employee_id"); }

}