<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "title", "name", "email", "phone", "mobile", "degree_id", "job_id", "departement_id", "company_id", "recruiter_id", "appreciation", "metsos_source_id", "expected_salary", "expected_salary_extra", "proposed_salary", "proposed_salary_extra", "availability", "description", "is_active", "date_closed", "date_open", "date_last_stage_up", "recruitment_stage_id", "last_recruitment_stage_id", "probability", "user_id"] ;

    public $public_data_rows = [['title','varchar'],['name','varchar'],['email','varchar'],['phone','varchar'],['mobile','varchar'],['degree_id','int'],['job_id','int'],['departement_id','int'],['company_id','int'],['recruiter_id','int'],['appreciation','int'],['metsos_source_id','int'],['expected_salary','double'],['expected_salary_extra','double'],['proposed_salary','double'],['proposed_salary_extra','double'],['availability','date'],['description','text'],['is_active','boolean'],['date_closed','date'],['date_open','date'],['date_last_stage_up','date'],['recruitment_stage_id','int'],['last_recruitment_stage_id','int'],['probability','double'],['user_id','int']] ;

    public $belongs_relation = [["foreign" => 'degree_id', "references" => 'id', "on" => 'degrees'],["foreign" => 'job_id', "references" => 'id', "on" => 'jobs'],["foreign" => 'departement_id', "references" => 'id', "on" => 'departements'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'metsos_source_id', "references" => 'id', "on" => 'metsos_sources'],["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users']] ;

    public $many_relation = [["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_tags'],["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_followers'],["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicant_comments']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'applicants';
        parent::__construct($attributes);
    }

    public function degree(){ return $this->belongsTo(Degree::class); }
    public function job(){ return $this->belongsTo(Job::class); }
    public function departement(){ return $this->belongsTo(Departement::class); }
    public function company(){ return $this->belongsTo(Company::class); }
    public function metsosSource(){ return $this->belongsTo(MetsosSource::class); }
    public function user(){ return $this->belongsTo(BadasoUser::class); }


    public function applicantApplicantTags(){ return $this->hasMany(ApplicantTag::class,"applicant_id"); }
    public function applicantApplicantFollowers(){ return $this->hasMany(ApplicantFollower::class,"applicant_id"); }
    public function applicantApplicantComments(){ return $this->hasMany(ApplicantComment::class,"applicant_id"); }

}