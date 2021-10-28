<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarReminder extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "calendar_event_id", "calendar_alaram_id"] ;

    public $public_data_rows = [['calendar_event_id','int'],['calendar_alaram_id','int']] ;

    public $belongs_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_events', "model_on" => CalendarEvent::class],["foreign" => 'calendar_alaram_id', "references" => 'id', "on" => 'calendar_alarams', "model_on" => CalendarAlaram::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_reminders';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(CalendarEvent::class, "calendar_event_id"); }
    public function calendarAlaram(){ return $this->belongsTo(CalendarAlaram::class, "calendar_alaram_id"); }



}