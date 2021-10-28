<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "color"] ;

    public $public_data_rows = [['name','varchar'],['color','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'employee_categorie_id', "references" => 'id', "on" => 'employee_tags', "model_on" => EmployeeTag::class],["foreign" => 'for_employee_categorie_id', "references" => 'id', "on" => 'time_off_allocations', "model_on" => TimeOffAllocation::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'employee_categories';
        parent::__construct($attributes);
    }



    public function employeeCategorieEmployeeTags(){ return $this->hasMany(EmployeeTag::class, "employee_categorie_id"); }
    public function forEmployeeCategorieTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "for_employee_categorie_id"); }

}