<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContract extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "responsible_user_id", "fleet_contract_type_id", "vendor_parent_id", "reference", "activation_cost", "recurring_cost", "recurring_cost_frequency", "fleet_vehicle_id", "invoice_date", "contract_start_date", "contract_expiration_date", "terms_conditions"] ;

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