<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "private_name", "status", "user_id", "manager_employee_id", "time_off_type_id", "employee_id", "departement_id", "notes", "date_from", "date_to", "number_of_day", "duration_display", "metting_calendar_event_id"] ;

    public $public_data_rows = [['private_name','varchar'],['status','enum'],['user_id','int'],['manager_employee_id','int'],['time_off_type_id','int'],['employee_id','int'],['departement_id','int'],['notes','text'],['date_from','datetime'],['date_to','datetime'],['number_of_day','double'],['duration_display','varchar'],['metting_calendar_event_id','varchar']] ;

    public $belongs_relation = [["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users'],["foreign" => 'manager_employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'time_off_type_id', "references" => 'id', "on" => 'time_off_types'],["foreign" => 'employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'departement_id', "references" => 'id', "on" => 'departements'],["foreign" => 'metting_calendar_event_id', "references" => 'id', "on" => 'calendar_events']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'time_offs';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(BadasoUser::class); }
    public function managerEmployee(){ return $this->belongsTo(Employee::class); }
    public function timeOffType(){ return $this->belongsTo(TimeOffType::class); }
    public function employee(){ return $this->belongsTo(Employee::class); }
    public function departement(){ return $this->belongsTo(Departement::class); }
    public function mettingCalendarEvent(){ return $this->belongsTo(CalendarEvent::class); }



}