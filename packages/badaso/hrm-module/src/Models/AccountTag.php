<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "applicability", "is_active", "country_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function country(){ return $this->belongsTo(Uasoft\Badaso\Models\Country::class); }

}