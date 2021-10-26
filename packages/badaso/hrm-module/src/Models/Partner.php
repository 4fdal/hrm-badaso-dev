<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "company_id", "name", "display_name", "parent_id", "lang", "timezone", "vat", "website", "credit_limit", "is_active", "type", "street1", "street2", "zip", "city", "state_id", "country_id", "latitude", "longitute", "email", "phone", "mobile", "is_comapany", "industry_id", "commercial_partner_id", "commercial_company_name", "company_name"] ;

    public $public_data_rows = [['company_id','int'],['name','varchar'],['display_name','varchar'],['parent_id','int'],['lang','varchar'],['timezone','varchar'],['vat','varchar'],['website','varchar'],['credit_limit','varchar'],['is_active','boolean'],['type','enum'],['street1','varchar'],['street2','varchar'],['zip','varchar'],['city','varchar'],['state_id','int'],['country_id','int'],['latitude','double'],['longitute','double'],['email','varchar'],['phone','varchar'],['mobile','varchar'],['is_comapany','double'],['industry_id','int'],['commercial_partner_id','int'],['commercial_company_name','varchar'],['company_name','varchar']] ;

    public $belongs_relation = [["foreign" => 'parent_id', "references" => 'id', "on" => 'partners'],["foreign" => 'industry_id', "references" => 'id', "on" => 'industries'],["foreign" => 'commercial_partner_id', "references" => 'id', "on" => 'partners'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'parent_id', "references" => 'id', "on" => 'partners'],["foreign" => 'commercial_partner_id', "references" => 'id', "on" => 'partners'],["foreign" => 'partner_id', "references" => 'id', "on" => 'companies'],["foreign" => 'partner_id', "references" => 'id', "on" => 'calendar_attendees'],["foreign" => 'partner_id', "references" => 'id', "on" => 'lunch_vendors'],["foreign" => 'partner_id', "references" => 'id', "on" => 'fleet_vendors'],["foreign" => 'driver_partner_id', "references" => 'id', "on" => 'fleet_vehicles'],["foreign" => 'future_driver_partner_id', "references" => 'id', "on" => 'fleet_vehicles'],["foreign" => 'driver_partner_id', "references" => 'id', "on" => 'fleet_services'],["foreign" => 'partner_id', "references" => 'id', "on" => 'partner_banks']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'partners';
        parent::__construct($attributes);
    }

    public function parent(){ return $this->belongsTo(Partner::class, "parent_id"); }
    public function industry(){ return $this->belongsTo(Industry::class, "industry_id"); }
    public function commercialPartner(){ return $this->belongsTo(Partner::class, "commercial_partner_id"); }
    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function parentPartners(){ return $this->hasMany(Partner::class, "parent_id"); }
    public function commercialPartnerPartners(){ return $this->hasMany(Partner::class, "commercial_partner_id"); }
    public function partnerCompanies(){ return $this->hasMany(Company::class, "partner_id"); }
    public function partnerCalendarAttendees(){ return $this->hasMany(CalendarAttendee::class, "partner_id"); }
    public function partnerLunchVendors(){ return $this->hasMany(LunchVendor::class, "partner_id"); }
    public function partnerFleetVendors(){ return $this->hasMany(FleetVendor::class, "partner_id"); }
    public function driverPartnerFleetVehicles(){ return $this->hasMany(FleetVehicle::class, "driver_partner_id"); }
    public function futureDriverPartnerFleetVehicles(){ return $this->hasMany(FleetVehicle::class, "future_driver_partner_id"); }
    public function driverPartnerFleetServices(){ return $this->hasMany(FleetService::class, "driver_partner_id"); }
    public function partnerPartnerBanks(){ return $this->hasMany(PartnerBank::class, "partner_id"); }

}