<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worke extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "company_id", "average_hours_per_day", "timezone"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}