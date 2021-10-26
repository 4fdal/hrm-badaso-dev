<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrder extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_id", "lunch_product_category_id", "date", "lunch_vendor_id", "user_id", "note", "price", "is_active", "state", "company_id", "currency_id", "quantity", "display_topping"] ;

    public $public_data_rows = [['lunch_product_id','int'],['lunch_product_category_id','int'],['date','date'],['lunch_vendor_id','int'],['user_id','int'],['note','text'],['price','double'],['is_active','boolean'],['state','enumu'],['company_id','int'],['currency_id','int'],['quantity','int'],['display_topping','varchar']] ;

    public $belongs_relation = [["foreign" => 'lunch_product_id', "references" => 'id', "on" => 'lunch_products'],["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_product_categories'],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_products'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies']] ;

    public $many_relation = [["foreign" => 'lunch_order_id', "references" => 'id', "on" => 'lunch_order_toppings']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_orders';
        parent::__construct($attributes);
    }

    public function lunchProduct(){ return $this->belongsTo(LunchProduct::class); }
    public function lunchProductCategory(){ return $this->belongsTo(LunchProductCategory::class); }
    public function lunchVendor(){ return $this->belongsTo(LunchProduct::class); }
    public function company(){ return $this->belongsTo(Company::class); }
    public function currency(){ return $this->belongsTo(Currency::class); }


    public function lunchOrderLunchOrderToppings(){ return $this->hasMany(LunchOrderTopping::class,"lunch_order_id"); }

}