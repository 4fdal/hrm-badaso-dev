<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "company_id", "is_active"] ;

    public $public_data_rows = [['name','varchar'],['company_id','int'],['is_active','boolean']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_products'],["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_orders']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_product_categories';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class); }


    public function lunchProductCategoryLunchProducts(){ return $this->hasMany(LunchProduct::class,"lunch_product_category_id"); }
    public function lunchProductCategoryLunchOrders(){ return $this->hasMany(LunchOrder::class,"lunch_product_category_id"); }

}