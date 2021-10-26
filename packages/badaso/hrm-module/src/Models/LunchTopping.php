<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchTopping extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "company_id", "price", "lunch_product_category_topping_id"] ;

    public $public_data_rows = [['name','varchar'],['company_id','int'],['price','double'],['lunch_product_category_topping_id','int']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'lunch_topping_id', "references" => 'id', "on" => 'lunch_order_toppings']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_toppings';
        parent::__construct($attributes);
    }



    public function lunchToppingLunchOrderToppings(){ return $this->hasMany(LunchOrderTopping::class, "lunch_topping_id"); }

}