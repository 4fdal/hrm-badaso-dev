<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "calendar_event_id", "calendar_event_category_id"] ;

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
    public function calendarEventCategory(){ return $this->belongsTo(Uasoft\Badaso\Models\CalendarEventCategory::class); }

}