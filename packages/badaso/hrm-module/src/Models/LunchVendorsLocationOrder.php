<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchVendorsLocationOrder extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_vendor_id", "lunch_locations_id"] ;

    public $public_data_rows = [['lunch_vendor_id','int'],['lunch_locations_id','int']] ;

    public $belongs_relation = [["foreign" => 'lunch_locations_id', "references" => 'id', "on" => 'lunch_locations', "model_on" => LunchLocation::class],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_vendors', "model_on" => LunchVendor::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_vendors_location_orders';
        parent::__construct($attributes);
    }

    public function lunchLocations(){ return $this->belongsTo(LunchLocation::class, "lunch_locations_id"); }
    public function lunchVendor(){ return $this->belongsTo(LunchVendor::class, "lunch_vendor_id"); }



}