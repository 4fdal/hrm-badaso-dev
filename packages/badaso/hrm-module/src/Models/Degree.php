<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name"] ;

    public $public_data_rows = [['name','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'certificate_level_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class],["foreign" => 'degree_id', "references" => 'id', "on" => 'applicants', "model_on" => Applicant::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'degrees';
        parent::__construct($attributes);
    }



    public function certificateLevelEmployees(){ return $this->hasMany(Employee::class, "certificate_level_id"); }
    public function degreeApplicants(){ return $this->hasMany(Applicant::class, "degree_id"); }

}