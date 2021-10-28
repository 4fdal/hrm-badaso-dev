<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = null;
    protected $fillable = ["name", "no_of_employee", "no_of_recruitment", "no_of_hired_employee", "reqruitment", "departement_id", "company_id", "description", "state", "address_id", "manager_id"];

    public $public_data_rows = [['name', 'varchar'], ['no_of_employee', 'int'], ['no_of_recruitment', 'int'], ['no_of_hired_employee', 'int'], ['reqruitment', 'text'], ['departement_id', 'int'], ['company_id', 'int'], ['description', 'text'], ['state', 'text'], ['address_id', 'int'], ['manager_id', 'int']];

    public $belongs_relation = [["foreign" => 'departement_id', "references" => 'id', "on" => 'departements', "model_on" => Departement::class], ["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class], ["foreign" => 'manager_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class]];

    public $many_relation = [["foreign" => 'job_id', "references" => 'id', "on" => 'recruitments', "model_on" => Recruitment::class], ["foreign" => 'job_id', "references" => 'id', "on" => 'applicants', "model_on" => Applicant::class]];

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix . 'jobs';
        parent::__construct($attributes);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, "departement_id");
    }
    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }
    public function manager()
    {
        return $this->belongsTo(Employee::class, "manager_id");
    }
    public function address(){
        return $this->belongsTo(Partner::class, 'address_id') ;
    }

    public function jobRecruitments()
    {
        return $this->hasMany(Recruitment::class, "job_id");
    }
    public function jobApplicants()
    {
        return $this->hasMany(Applicant::class, "job_id");
    }
}
