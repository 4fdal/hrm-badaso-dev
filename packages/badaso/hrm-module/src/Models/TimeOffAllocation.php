<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffAllocation extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "time_off_type_id", "allocation_types", "number_of_day", "holiday_mode", "for_employee_id", "for_company_id", "for_departement_id", "for_employee_categorie_id", "description", "first_approve_employee_id", "second_approve_employee_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function timeOffType(){ return $this->belongsTo(Uasoft\Badaso\Models\TimeOffType::class); }
    public function forEmployee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function forCompany(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function forDepartement(){ return $this->belongsTo(Uasoft\Badaso\Models\Departement::class); }
    public function forEmployeeCategorie(){ return $this->belongsTo(Uasoft\Badaso\Models\EmployeeCategory::class); }
    public function firstApproveEmployee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function secondApproveEmployee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }

}