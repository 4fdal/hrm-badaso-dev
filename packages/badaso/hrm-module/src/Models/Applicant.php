<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Uasoft\Badaso\Models\User as BadasoUser;

class Applicant extends Model
{
    use HasFactory;

    protected $table = null;
    protected $fillable = ["title", "name", "email", "phone", "mobile", "degree_id", "job_id", "departement_id", "company_id", "recruiter_id", "appreciation", "metsos_source_id", "expected_salary", "expected_salary_extra", "proposed_salary", "proposed_salary_extra", "availability", "description", "is_active", "date_closed", "date_open", "date_last_stage_up", "recruitment_stage_id", "last_recruitment_stage_id", "probability", "user_id"];

    public $public_data_rows = [['title', 'varchar'], ['name', 'varchar'], ['email', 'varchar'], ['phone', 'varchar'], ['mobile', 'varchar'], ['degree_id', 'int'], ['job_id', 'int'], ['departement_id', 'int'], ['company_id', 'int'], ['recruiter_id', 'int'], ['appreciation', 'int'], ['metsos_source_id', 'int'], ['expected_salary', 'double'], ['expected_salary_extra', 'double'], ['proposed_salary', 'double'], ['proposed_salary_extra', 'double'], ['availability', 'date'], ['description', 'text'], ['is_active', 'boolean'], ['date_closed', 'date'], ['date_open', 'date'], ['date_last_stage_up', 'date'], ['recruitment_stage_id', 'int'], ['last_recruitment_stage_id', 'int'], ['probability', 'double'], ['user_id', 'int']];

    public $belongs_relation = [["foreign" => 'degree_id', "references" => 'id', "on" => 'degrees', "model_on" => Degree::class], ["foreign" => 'job_id', "references" => 'id', "on" => 'jobs', "model_on" => Job::class], ["foreign" => 'departement_id', "references" => 'id', "on" => 'departements', "model_on" => Departement::class], ["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class], ["foreign" => 'metsos_source_id', "references" => 'id', "on" => 'metsos_sources', "model_on" => MetsosSource::class], ["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class]];

    public $many_relation = [["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_tags', "model_on" => ApplicantTag::class], ["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_followers', "model_on" => ApplicantFollower::class], ["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_comments', "model_on" => ApplicantComment::class]];

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
}
