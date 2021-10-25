<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrderTopping extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_order_id", "lunch_topping_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchOrder(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchOrder::class); }
    public function lunchTopping(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchTopping::class); }

}