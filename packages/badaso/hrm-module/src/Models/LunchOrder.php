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

    public $belongs_relation = [["foreign" => 'lunch_product_id', "references" => 'id', "on" => 'lunch_products', "model_on" => LunchProduct::class],["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_product_categories', "model_on" => LunchProductCategory::class],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_products', "model_on" => LunchProduct::class],["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class],["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies', "model_on" => Currency::class]] ;

    public $many_relation = [["foreign" => 'lunch_order_id', "references" => 'id', "on" => 'lunch_order_toppings', "model_on" => LunchOrderTopping::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_orders';
        parent::__construct($attributes);
    }

    public function lunchProduct(){ return $this->belongsTo(LunchProduct::class, "lunch_product_id"); }
    public function lunchProductCategory(){ return $this->belongsTo(LunchProductCategory::class, "lunch_product_category_id"); }
    public function lunchVendor(){ return $this->belongsTo(LunchProduct::class, "lunch_vendor_id"); }
    public function company(){ return $this->belongsTo(Company::class, "company_id"); }
    public function currency(){ return $this->belongsTo(Currency::class, "currency_id"); }


    public function lunchOrderLunchOrderToppings(){ return $this->hasMany(LunchOrderTopping::class, "lunch_order_id"); }

}