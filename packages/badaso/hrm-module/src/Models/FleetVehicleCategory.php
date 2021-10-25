<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "color", "user_id"] ;

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