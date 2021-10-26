<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetVehicleCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "color", "user_id"] ;

    public $public_data_rows = [['name','varchar'],['color','varchar'],['user_id','int']] ;

    public $belongs_relation = [["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users']] ;

    public $many_relation = [["foreign" => 'fleet_vehicle_categorie_id', "references" => 'id', "on" => 'fleet_vehicle_tags']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_vehicle_categories';
        parent::__construct($attributes);
    }

    public function user(){ return $this->belongsTo(BadasoUser::class); }


    public function fleetVehicleCategorieFleetVehicleTags(){ return $this->hasMany(FleetVehicleTag::class,"fleet_vehicle_categorie_id"); }

}