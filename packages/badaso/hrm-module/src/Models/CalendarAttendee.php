<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarAttendee extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "common_name", "calendar_event_id", "partner_id"] ;

    public $public_data_rows = [['common_name','varchar'],['calendar_event_id','int'],['partner_id','int']] ;

    public $belongs_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_events'],["foreign" => 'partner_id', "references" => 'id', "on" => 'partners']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_attendees';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(CalendarEvent::class); }
    public function partner(){ return $this->belongsTo(Partner::class); }



}