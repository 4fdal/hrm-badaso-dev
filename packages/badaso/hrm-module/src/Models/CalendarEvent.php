<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "start", "stop", "is_all_day", "duration", "description", "privacy", "localtion", "user_id", "is_active", "is_recurrent", "show_as"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}