<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetModel extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "fleet_model_brand_id", "manager_user_id", "is_active", "vehicle_type"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetModelBrand(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetModelBrand::class); }
    public function managerUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}