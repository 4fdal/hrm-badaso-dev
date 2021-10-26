<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarRecruitmentEvent extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "done_status", "calendar_event_id"] ;

    public $public_data_rows = [['done_status','boolean'],['calendar_event_id','int']] ;

    public $belongs_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_events']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_recruitment_events';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(CalendarEvent::class, "calendar_event_id"); }



}