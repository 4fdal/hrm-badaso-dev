<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "no_of_employee", "no_of_recruitment", "no_of_hired_employee", "reqruitment", "departement_id", "company_id", "description", "state", "address_id", "manager_id"] ;

    public $public_data_rows = [['name','varchar'],['no_of_employee','int'],['no_of_recruitment','int'],['no_of_hired_employee','int'],['reqruitment','text'],['departement_id','int'],['company_id','int'],['description','text'],['state','text'],['address_id','int'],['manager_id','int']] ;

    public $belongs_relation = [["foreign" => 'departement_id', "references" => 'id', "on" => 'departements'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'manager_id', "references" => 'id', "on" => 'employees']] ;

    public $many_relation = [["foreign" => 'job_id', "references" => 'id', "on" => 'recruitments'],["foreign" => 'job_id', "references" => 'id', "on" => 'applicants']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'jobs';
        parent::__construct($attributes);
    }

    public function departement(){ return $this->belongsTo(Departement::class); }
    public function company(){ return $this->belongsTo(Company::class); }
    public function manager(){ return $this->belongsTo(Employee::class); }


    public function jobRecruitments(){ return $this->hasMany(Recruitment::class,"job_id"); }
    public function jobApplicants(){ return $this->hasMany(Applicant::class,"job_id"); }

}