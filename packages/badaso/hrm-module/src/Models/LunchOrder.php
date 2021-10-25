<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchOrder extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_id", "lunch_product_category_id", "date", "lunch_vendor_id", "user_id", "note", "price", "is_active", "state", "company_id", "currency_id", "quantity", "display_topping"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function lunchProduct(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchProduct::class); }
    public function lunchProductCategory(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchProductCategory::class); }
    public function lunchVendor(){ return $this->belongsTo(Uasoft\Badaso\Models\LunchProduct::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function currency(){ return $this->belongsTo(Uasoft\Badaso\Models\Currency::class); }

}