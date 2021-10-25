<?php

namespace App\Models;

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
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function parent(){ return $this->belongsTo(Uasoft\Badaso\Models\Departement::class); }
    public function manager(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }

}