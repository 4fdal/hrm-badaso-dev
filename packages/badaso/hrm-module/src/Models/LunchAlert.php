<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchAlert extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "message", "display_mode", "show_until", "is_recurrent_monday", "is_recurrent_tuesday", "is_recurrent_wednesday", "is_recurrent_thursday", "is_recurrent_friday", "is_recurrent_saturday", "is_recurrent_sunday", "is_active", "timezone"] ;

    public $public_data_rows = [['name','varchar'],['message','varchar'],['display_mode','enum'],['show_until','date'],['is_recurrent_monday','boolean'],['is_recurrent_tuesday','boolean'],['is_recurrent_wednesday','boolean'],['is_recurrent_thursday','boolean'],['is_recurrent_friday','boolean'],['is_recurrent_saturday','boolean'],['is_recurrent_sunday','boolean'],['is_active','boolean'],['timezone','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'lunch_alert_id', "references" => 'id', "on" => 'lunch_alert_locations']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_alerts';
        parent::__construct($attributes);
    }



    public function lunchAlertLunchAlertLocations(){ return $this->hasMany(LunchAlertLocation::class,"lunch_alert_id"); }

}