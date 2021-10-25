<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRecurrent extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "calendar_event_id", "name", "event_tz", "rrule", "rrule_type", "end_type", "interval", "count", "mo", "tu", "we", "th", "fr", "sa", "su", "month_by", "day", "byday", "until"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(Uasoft\Badaso\Models\CalendarEvent::class); }

}