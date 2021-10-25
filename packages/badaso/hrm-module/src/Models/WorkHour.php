<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "work_id", "name", "day_of_week", "day_period", "work_from", "work_to", "start_date", "end_date"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function work(){ return $this->belongsTo(Uasoft\Badaso\Models\Worke::class); }

}