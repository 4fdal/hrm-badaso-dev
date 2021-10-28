<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worke extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "company_id", "average_hours_per_day", "timezone"] ;

    public $public_data_rows = [['company_id','int'],['average_hours_per_day','time'],['timezone','varchar']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class]] ;

    public $many_relation = [["foreign" => 'work_id', "references" => 'id', "on" => 'work_hours', "model_on" => WorkHour::class],["foreign" => 'worke_id', "references" => 'id', "on" => 'global_time_offs', "model_on" => GlobalTimeOff::class],["foreign" => 'work_id', "references" => 'id', "on" => 'employees', "model_on" => Employee::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'workes';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function workWorkHours(){ return $this->hasMany(WorkHour::class, "work_id"); }
    public function workeGlobalTimeOffs(){ return $this->hasMany(GlobalTimeOff::class, "worke_id"); }
    public function workEmployees(){ return $this->hasMany(Employee::class, "work_id"); }

}