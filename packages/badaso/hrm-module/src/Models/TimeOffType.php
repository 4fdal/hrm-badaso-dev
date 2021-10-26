<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "is_create_calendar", "is_active", "color", "company_id", "name", "payroll_code", "take_time_off_types", "responsible_user_id", "allocation_types", "allocation_validation_types", "validity_start", "validity_stop", "time_off_validation_types"] ;

    public $public_data_rows = [['is_create_calendar','boolean'],['is_active','boolean'],['color','varchar'],['company_id','int'],['name','varchar'],['payroll_code','varchar'],['take_time_off_types','enum'],['responsible_user_id','int'],['allocation_types','enum'],['allocation_validation_types','enum'],['validity_start','date'],['validity_stop','date'],['time_off_validation_types','enum']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'responsible_user_id', "references" => 'id', "on" => 'badaso_users']] ;

    public $many_relation = [["foreign" => 'time_off_type_id', "references" => 'id', "on" => 'time_off_allocations'],["foreign" => 'time_off_type_id', "references" => 'id', "on" => 'time_offs']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'time_off_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }
    public function responsibleUser(){ return $this->belongsTo(BadasoUser::class, "responsible_user_id"); }


    public function timeOffTypeTimeOffAllocations(){ return $this->hasMany(TimeOffAllocation::class, "time_off_type_id"); }
    public function timeOffTypeTimeOffs(){ return $this->hasMany(TimeOff::class, "time_off_type_id"); }

}