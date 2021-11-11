<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Uasoft\Badaso\Models\User as BadasoUser;

class Applicant extends Model
{
    use HasFactory;

    protected $table = null;
    protected $fillable = ["title", "name", "email", "phone", "mobile", "degree_id", "job_id", "departement_id", "company_id", "recruiter_id", "appreciation", "metsos_source_id", "expected_salary", "expected_salary_extra", "proposed_salary", "proposed_salary_extra", "availability", "description", "is_active", "date_closed", "date_open", "date_last_stage_up", "recruitment_stage_id", "last_recruitment_stage_id", "probability", "user_id", "recruitment_id"];

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix . 'applicants';
        parent::__construct($attributes);
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class, "degree_id");
    }
    public function job()
    {
        return $this->belongsTo(Job::class, "job_id");
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class, "departement_id");
    }
    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }
    public function metsosSource()
    {
        return $this->belongsTo(MetsosSource::class, "metsos_source_id");
    }
    public function user()
    {
        return $this->belongsTo(BadasoUser::class, "user_id");
    }
    public function recruiter()
    {
        return $this->belongsTo(BadasoUser::class, 'user_id');
    }
    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class, "recruitment_id");
    }
    public function applicantApplicantTags()
    {
        return $this->hasMany(ApplicantTag::class, "applicant_id");
    }
    public function applicantApplicantFollowers()
    {
        return $this->hasMany(ApplicantFollower::class, "applicant_id");
    }
    public function applicantApplicantComments()
    {
        return $this->hasMany(ApplicantComment::class, "applicant_id");
    }
    public function applicantRefuseType(){
        return $this->hasOne(ApplicantRefuseType::class, "applicant_refuse_type_id");
    }
}
