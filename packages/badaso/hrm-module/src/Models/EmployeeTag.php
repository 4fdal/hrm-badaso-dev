<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "employee_id", "employee_categorie_id"] ;

    public $public_data_rows = [['employee_id','int'],['employee_categorie_id','int']] ;

    public $belongs_relation = [["foreign" => 'employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'employee_categorie_id', "references" => 'id', "on" => 'employee_categories']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employee_tags';
        parent::__construct($attributes);
    }

    public function employee(){ return $this->belongsTo(Employee::class, "employee_id"); }
    public function employeeCategorie(){ return $this->belongsTo(EmployeeCategory::class, "employee_categorie_id"); }



}