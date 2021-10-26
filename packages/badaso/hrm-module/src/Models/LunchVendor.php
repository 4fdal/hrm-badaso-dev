<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchVendor extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "partner_id", "company_id", "responsible_user_id", "send_by", "automatic_email_time", "is_recurrent_monday", "is_recurrent_tuesday", "is_recurrent_wednesday", "is_recurrent_thursday", "is_recurrent_friday", "is_recurrent_saturday", "is_recurrent_sunday", "timezone", "is_active", "moment", "delivery"] ;

    public $public_data_rows = [['partner_id','int'],['company_id','int'],['responsible_user_id','int'],['send_by','enum'],['automatic_email_time','double'],['is_recurrent_monday','boolean'],['is_recurrent_tuesday','boolean'],['is_recurrent_wednesday','boolean'],['is_recurrent_thursday','boolean'],['is_recurrent_friday','boolean'],['is_recurrent_saturday','boolean'],['is_recurrent_sunday','boolean'],['timezone','varchar'],['is_active','boolean'],['moment','enum'],['delivery','enum']] ;

    public $belongs_relation = [["foreign" => 'partner_id', "references" => 'id', "on" => 'partners'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'responsible_user_id', "references" => 'id', "on" => 'badaso_users']] ;

    public $many_relation = [["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_vendors_location_orders'],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_products']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_vendors';
        parent::__construct($attributes);
    }

    public function partner(){ return $this->belongsTo(Partner::class, "partner_id"); }
    public function company(){ return $this->belongsTo(Company::class, "company_id"); }
    public function responsibleUser(){ return $this->belongsTo(BadasoUser::class, "responsible_user_id"); }


    public function lunchVendorLunchVendorsLocationOrders(){ return $this->hasMany(LunchVendorsLocationOrder::class, "lunch_vendor_id"); }
    public function lunchVendorLunchProducts(){ return $this->hasMany(LunchProduct::class, "lunch_vendor_id"); }

}