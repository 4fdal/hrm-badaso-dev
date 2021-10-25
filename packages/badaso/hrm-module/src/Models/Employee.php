<?php

namespace App\Models;

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
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }
    public function approveTimeOffUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }
    public function approveExpensesUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }
    public function work(){ return $this->belongsTo(Uasoft\Badaso\Models\Worke::class); }
    public function certificateLevel(){ return $this->belongsTo(Uasoft\Badaso\Models\Degree::class); }
    public function country(){ return $this->belongsTo(Uasoft\Badaso\Models\Country::class); }
    public function countryOfBirth(){ return $this->belongsTo(Uasoft\Badaso\Models\Country::class); }

}