<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVendor extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "fleet_model_id", "partner_id"] ;

    public $public_data_rows = [['fleet_model_id','int'],['partner_id','int']] ;

    public $belongs_relation = [["foreign" => 'fleet_model_id', "references" => 'id', "on" => 'fleet_models'],["foreign" => 'partner_id', "references" => 'id', "on" => 'partners']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_vendors';
        parent::__construct($attributes);
    }

    public function fleetModel(){ return $this->belongsTo(FleetModel::class, "fleet_model_id"); }
    public function partner(){ return $this->belongsTo(Partner::class, "partner_id"); }



}