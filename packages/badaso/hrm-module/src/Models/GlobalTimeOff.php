<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalTimeOff extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "worke_id", "reason", "start_date", "end_date"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function worke(){ return $this->belongsTo(Uasoft\Badaso\Models\Worke::class); }

}