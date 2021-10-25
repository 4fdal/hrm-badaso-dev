<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProduct extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "lunch_product_category_id", "description", "price", "lunch_vendor_id", "is_active", "company_id", "new_until"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchProductCategory(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchProductCategory::class); }
    public function lunchVendor(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchVendor::class); }

}