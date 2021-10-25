<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductCategoryToppingItem extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_category_topping_id", "name", "price"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchProductCategoryTopping(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchProductCategoryTopping::class); }

}