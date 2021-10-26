<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchAlertLocation extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_alert_id", "lunch_location_id"] ;

    public $public_data_rows = [['lunch_alert_id','int'],['lunch_location_id','int']] ;

    public $belongs_relation = [["foreign" => 'lunch_alert_id', "references" => 'id', "on" => 'lunch_alerts'],["foreign" => 'lunch_location_id', "references" => 'id', "on" => 'lunch_locations']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_alert_locations';
        parent::__construct($attributes);
    }

    public function lunchAlert(){ return $this->belongsTo(LunchAlert::class, "lunch_alert_id"); }
    public function lunchLocation(){ return $this->belongsTo(LunchLocation::class, "lunch_location_id"); }



}