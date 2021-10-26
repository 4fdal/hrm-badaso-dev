<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "start", "stop", "is_all_day", "duration", "description", "privacy", "localtion", "user_id", "is_active", "is_recurrent", "show_as"] ;

    public $public_data_rows = [['name','varchar'],['start','date'],['stop','date'],['is_all_day','boolean'],['duration','double'],['description','text'],['privacy','varchar'],['localtion','varchar'],['user_id','int'],['is_active','boolean'],['is_recurrent','boolean'],['show_as','enum']] ;

    public $belongs_relation = [["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users']] ;

    public $many_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_event_tags'],["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_recurrents'],["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_attendees'],["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_reminders'],["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_recruitment_events'],["foreign" => 'metting_calendar_event_id', "references" => 'id', "on" => 'time_offs']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_events';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(BadasoUser::class, "user_id"); }


    public function calendarEventCalendarEventTags(){ return $this->hasMany(CalendarEventTag::class, "calendar_event_id"); }
    public function calendarEventCalendarRecurrents(){ return $this->hasMany(CalendarRecurrent::class, "calendar_event_id"); }
    public function calendarEventCalendarAttendees(){ return $this->hasMany(CalendarAttendee::class, "calendar_event_id"); }
    public function calendarEventCalendarReminders(){ return $this->hasMany(CalendarReminder::class, "calendar_event_id"); }
    public function calendarEventCalendarRecruitmentEvents(){ return $this->hasMany(CalendarRecruitmentEvent::class, "calendar_event_id"); }
    public function mettingCalendarEventTimeOffs(){ return $this->hasMany(TimeOff::class, "metting_calendar_event_id"); }

}