<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategoryToppingItem extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_category_topping_id", "name", "price"] ;

    public $public_data_rows = [['lunch_product_category_topping_id','int'],['name','varchar'],['price','double']] ;

    public $belongs_relation = [["foreign" => 'lunch_product_category_topping_id', "references" => 'id', "on" => 'lunch_product_category_toppings']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_product_category_topping_items';
        parent::__construct($attributes);
    }

    public function lunchProductCategoryTopping(){ return $this->belongsTo(LunchProductCategoryTopping::class); }



}