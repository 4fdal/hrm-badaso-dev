<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchLocation extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "address", "company_id"] ;

    public $public_data_rows = [['name','varchar'],['address','varchar'],['company_id','int']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'lunch_locations_id', "references" => 'id', "on" => 'lunch_vendors_location_orders'],["foreign" => 'lunch_location_id', "references" => 'id', "on" => 'lunch_alert_locations']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_locations';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function lunchLocationsLunchVendorsLocationOrders(){ return $this->hasMany(LunchVendorsLocationOrder::class, "lunch_locations_id"); }
    public function lunchLocationLunchAlertLocations(){ return $this->hasMany(LunchAlertLocation::class, "lunch_location_id"); }

}