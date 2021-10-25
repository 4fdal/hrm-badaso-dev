<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVendor extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_model_id", "partner_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function fleetModel(){ return $this->belongsTo(Uasoft\Badaso\Models\FleetModel::class); }
    public function partner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }

}