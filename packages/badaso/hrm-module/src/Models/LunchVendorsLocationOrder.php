<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchVendorsLocationOrder extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_vendor_id", "lunch_locations_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchLocations(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchLocation::class); }
    public function lunchVendor(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchVendor::class); }

}