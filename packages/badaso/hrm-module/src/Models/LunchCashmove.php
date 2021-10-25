<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchCashmove extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "currency_id", "user_id", "date", "amount", "description"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Uasoft\Badaso\Models\Currency::class); }
    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}