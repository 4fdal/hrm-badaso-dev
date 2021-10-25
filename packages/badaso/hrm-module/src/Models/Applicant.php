<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "title", "name", "email", "phone", "mobile", "degree_id", "job_id", "departement_id", "company_id", "recruiter_id", "appreciation", "metsos_source_id", "expected_salary", "expected_salary_extra", "proposed_salary", "proposed_salary_extra", "availability", "description", "is_active", "date_closed", "date_open", "date_last_stage_up", "recruitment_stage_id", "last_recruitment_stage_id", "probability", "user_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function degree(){ return $this->belongsTo(Uasoft\Badaso\Models\Degree::class); }
    public function job(){ return $this->belongsTo(Uasoft\Badaso\Models\Job::class); }
    public function departement(){ return $this->belongsTo(Uasoft\Badaso\Models\Departement::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function metsosSource(){ return $this->belongsTo(Uasoft\Badaso\Models\MetsosSource::class); }
    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}