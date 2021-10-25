<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "street1", "street2", "zip", "state_id", "company_id", "email", "phone", "is_active", "bic"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function state(){ return $this->belongsTo(Uasoft\Badaso\Models\State::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}