<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrderTopping extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_order_id", "lunch_topping_id"] ;

    public $public_data_rows = [['lunch_order_id','int'],['lunch_topping_id','int']] ;

    public $belongs_relation = [["foreign" => 'lunch_order_id', "references" => 'id', "on" => 'lunch_orders'],["foreign" => 'lunch_topping_id', "references" => 'id', "on" => 'lunch_toppings']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_order_toppings';
        parent::__construct($attributes);
    }

    public function lunchOrder(){ return $this->belongsTo(LunchOrder::class); }
    public function lunchTopping(){ return $this->belongsTo(LunchTopping::class); }



}