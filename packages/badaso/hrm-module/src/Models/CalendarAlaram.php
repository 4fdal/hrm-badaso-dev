<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarAlaram extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "alaram_type", "duration", "interval"] ;

    public $public_data_rows = [['name','varchar'],['alaram_type','enum'],['duration','int'],['interval','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'calendar_alaram_id', "references" => 'id', "on" => 'calendar_reminders']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'calendar_alarams';
        parent::__construct($attributes);
    }



    public function calendarAlaramCalendarReminders(){ return $this->hasMany(CalendarReminder::class, "calendar_alaram_id"); }

}