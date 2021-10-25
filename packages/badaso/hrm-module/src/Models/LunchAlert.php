<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchAlert extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "message", "display_mode", "show_until", "is_recurrent_monday", "is_recurrent_tuesday", "is_recurrent_wednesday", "is_recurrent_thursday", "is_recurrent_friday", "is_recurrent_saturday", "is_recurrent_sunday", "is_active", "timezone"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }


}