<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "complete_name", "is_active", "company_id", "parent_id", "manager_id", "note", "color"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'departements';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }
    public function parent(){ return $this->belongsTo(Departement::class, "parent_id"); }
    public function manager(){ return $this->belongsTo(Employee::class, "manager_id"); }


    public function parentDepartements(){ return $this->hasMany(Departement::class, "parent_id"); }
    public function departementJobs(){ return $this->hasMany(Job::class, "departement_id"); }
    public function departementApplicants(){ return $this->hasMany(Applicant::class, "departement_id"); }
    public function forDepartementTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "for_departement_id"); }
    public function departementTimeOffs(){ return $this->hasMany(TimeOff::class, "departement_id"); }

}
