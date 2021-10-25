<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "private_name", "status", "user_id", "manager_employee_id", "time_off_type_id", "employee_id", "departement_id", "notes", "date_from", "date_to", "number_of_day", "duration_display", "metting_calendar_event_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }
    public function managerEmployee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function timeOffType(){ return $this->belongsTo(Uasoft\Badaso\Models\TimeOffType::class); }
    public function employee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function departement(){ return $this->belongsTo(Uasoft\Badaso\Models\Departement::class); }
    public function mettingCalendarEvent(){ return $this->belongsTo(Uasoft\Badaso\Models\CalendarEvent::class); }

}