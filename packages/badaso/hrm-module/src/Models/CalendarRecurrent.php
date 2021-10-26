<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRecurrent extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "calendar_event_id", "name", "event_tz", "rrule", "rrule_type", "end_type", "interval", "count", "mo", "tu", "we", "th", "fr", "sa", "su", "month_by", "day", "byday", "until"] ;

    public $public_data_rows = [['calendar_event_id','int'],['name','varchar'],['event_tz','varchar'],['rrule','varchar'],['rrule_type','varchar'],['end_type','varchar'],['interval','int'],['count','int'],['mo','boolean'],['tu','boolean'],['we','boolean'],['th','boolean'],['fr','boolean'],['sa','boolean'],['su','boolean'],['month_by','varchar'],['day','int'],['byday','varchar'],['until','date']] ;

    public $belongs_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_events']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_recurrents';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(CalendarEvent::class, "calendar_event_id"); }



}