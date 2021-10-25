<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "employee_id", "employee_categorie_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function employee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function employeeCategorie(){ return $this->belongsTo(Uasoft\Badaso\Models\EmployeeCategory::class); }

}