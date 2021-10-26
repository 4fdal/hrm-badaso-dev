<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProduct extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "lunch_product_category_id", "description", "price", "lunch_vendor_id", "is_active", "company_id", "new_until"] ;

    public $public_data_rows = [['name','varchar'],['lunch_product_category_id','int'],['description','text'],['price','double'],['lunch_vendor_id','int'],['is_active','boolean'],['company_id','int'],['new_until','date']] ;

    public $belongs_relation = [["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_product_categories'],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_vendors']] ;

    public $many_relation = [["foreign" => 'lunch_product_id', "references" => 'id', "on" => 'lunch_product_favorites'],["foreign" => 'lunch_product_id', "references" => 'id', "on" => 'lunch_orders'],["foreign" => 'lunch_vendor_id', "references" => 'id', "on" => 'lunch_orders']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_products';
        parent::__construct($attributes);
    }

    public function lunchProductCategory(){ return $this->belongsTo(LunchProductCategory::class, "lunch_product_category_id"); }
    public function lunchVendor(){ return $this->belongsTo(LunchVendor::class, "lunch_vendor_id"); }


    public function lunchProductLunchProductFavorites(){ return $this->hasMany(LunchProductFavorite::class, "lunch_product_id"); }
    public function lunchProductLunchOrders(){ return $this->hasMany(LunchOrder::class, "lunch_product_id"); }
    public function lunchVendorLunchOrders(){ return $this->hasMany(LunchOrder::class, "lunch_vendor_id"); }

}