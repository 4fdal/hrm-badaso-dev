<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "calendar_event_id", "calendar_event_category_id"] ;

    public $public_data_rows = [['calendar_event_id','int'],['calendar_event_category_id','int']] ;

    public $belongs_relation = [["foreign" => 'calendar_event_id', "references" => 'id', "on" => 'calendar_events'],["foreign" => 'calendar_event_category_id', "references" => 'id', "on" => 'calendar_event_categories']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_event_tags';
        parent::__construct($attributes);
    }

    public function calendarEvent(){ return $this->belongsTo(CalendarEvent::class); }
    public function calendarEventCategory(){ return $this->belongsTo(CalendarEventCategory::class); }



}