<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "user_id", "name", "job_postion_name", "work_mobile", "work_phone", "work_email", "departement_id", "company_id", "coach_id", "is_active", "work_address_id", "work_location", "approve_time_off_user_id", "approve_expenses_user_id", "work_id", "tz", "address_id", "email", "phone", "home_work_distance", "marital_status", "emergency_contanct", "emergency_phone", "certificate_level_id", "field_of_study", "school", "country_id", "identification_no", "pasport_no", "gender", "data_of_birth", "place_of_birth", "country_of_birth_id", "no_of_children", "visa_no", "work_permit_no", "visa_expire_data", "job_id", "mobility_card", "pin_code", "id_badge"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employees';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(BadasoUser::class, "user_id"); }
    public function approveTimeOffUser(){ return $this->belongsTo(BadasoUser::class, "approve_time_off_user_id"); }
    public function approveExpensesUser(){ return $this->belongsTo(BadasoUser::class, "approve_expenses_user_id"); }
    public function work(){ return $this->belongsTo(Worke::class, "work_id"); }
    public function certificateLevel(){ return $this->belongsTo(Degree::class, "certificate_level_id"); }
    public function country(){ return $this->belongsTo(Country::class, "country_id"); }
    public function countryOfBirth(){ return $this->belongsTo(Country::class, "country_of_birth_id"); }


    public function employeeEmployeeTags(){ return $this->hasMany(EmployeeTag::class, "employee_id"); }
    public function employeeEmployeeResumes(){ return $this->hasMany(EmployeeResume::class, "employee_id"); }
    public function employeeEmployeeAttendances(){ return $this->hasMany(EmployeeAttendance::class, "employee_id"); }
    public function managerDepartements(){ return $this->hasMany(Departement::class, "manager_id"); }
    public function managerJobs(){ return $this->hasMany(Job::class, "manager_id"); }
    public function forEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "for_employee_id"); }
    public function firstApproveEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "first_approve_employee_id"); }
    public function secondApproveEmployeeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "second_approve_employee_id"); }
    public function managerEmployeeTimeOffs(){ return $this->hasMany(TimeOff::class, "manager_employee_id"); }
    public function employeeTimeOffs(){ return $this->hasMany(TimeOff::class, "employee_id"); }
    public function employeeExpenseReports(){ return $this->hasMany(ExpenseReport::class, "employee_id"); }

}
