<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = "employees" ;
    protected $fillable = [ "user_id", "name", "job_postion_name", "work_mobile", "work_phone", "work_email", "departement_id", "company_id", "coach_id", "is_active", "work_address_id", "work_location", "approve_time_off_user_id", "approve_expenses_user_id", "work_id", "tz", "address_id", "email", "phone", "home_work_distance", "marital_status", "emergency_contanct", "emergency_phone", "certificate_level_id", "field_of_study", "school", "country_id", "identification_no", "pasport_no", "gender", "data_of_birth", "place_of_birth", "country_of_birth_id", "no_of_children", "visa_no", "work_permit_no", "visa_expire_data", "job_id", "mobility_card", "pin_code", "id_badge"] ;
}