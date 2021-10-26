<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategoryTopping extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_category_id", "name"] ;

    public $public_data_rows = [['lunch_product_category_id','int'],['name','varchar']] ;

    public $belongs_relation = [["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_product_category_toppings']] ;

    public $many_relation = [["foreign" => 'lunch_product_category_id', "references" => 'id', "on" => 'lunch_product_category_toppings'],["foreign" => 'lunch_product_category_topping_id', "references" => 'id', "on" => 'lunch_product_category_topping_items']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_product_category_toppings';
        parent::__construct($attributes);
    }

    public function lunchProductCategory(){ return $this->belongsTo(LunchProductCategoryTopping::class, "lunch_product_category_id"); }


    public function lunchProductCategoryLunchProductCategoryToppings(){ return $this->hasMany(LunchProductCategoryTopping::class, "lunch_product_category_id"); }
    public function lunchProductCategoryToppingLunchProductCategoryToppingItems(){ return $this->hasMany(LunchProductCategoryToppingItem::class, "lunch_product_category_topping_id"); }

}