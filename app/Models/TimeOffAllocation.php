<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffAllocation extends Model
{
    use HasFactory;

    protected $table = "time_off_allocations" ;
    protected $fillable = [ "name", "time_off_type_id", "allocation_types", "number_of_day", "holiday_mode", "for_employee_id", "for_company_id", "for_departement_id", "for_employee_categorie_id", "description", "first_approve_employee_id", "second_approve_employee_id"] ;
}