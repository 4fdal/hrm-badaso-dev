<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductFavorite extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_id", "user_id"] ;

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
    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}