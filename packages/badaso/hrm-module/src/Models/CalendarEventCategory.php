<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEventCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name"] ;

    public $public_data_rows = [['name','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'calendar_event_category_id', "references" => 'id', "on" => 'calendar_event_tags']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_event_categories';
        parent::__construct($attributes);
    }



    public function calendarEventCategoryCalendarEventTags(){ return $this->hasMany(CalendarEventTag::class,"calendar_event_category_id"); }

}