<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "no_of_employee", "no_of_recruitment", "no_of_hired_employee", "reqruitment", "departement_id", "company_id", "description", "state", "address_id", "manager_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function departement(){ return $this->belongsTo(Uasoft\Badaso\Models\Departement::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function manager(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }

}