<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = "applicants" ;
    protected $fillable = [ "title", "name", "email", "phone", "mobile", "degree_id", "job_id", "departement_id", "company_id", "recruiter_id", "appreciation", "metsos_source_id", "expected_salary", "expected_salary_extra", "proposed_salary", "proposed_salary_extra", "availability", "description", "is_active", "date_closed", "date_open", "date_last_stage_up", "recruitment_stage_id", "last_recruitment_stage_id", "probability", "user_id"] ;
}