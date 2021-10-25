<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchAlertLocation extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_alert_id", "lunch_location_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchAlert(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchAlert::class); }
    public function lunchLocation(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchLocation::class); }

}