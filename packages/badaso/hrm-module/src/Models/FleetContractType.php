<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FleetContractType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "category"] ;

    public $public_data_rows = [['name','varchar'],['category','enum']] ;

    public $belongs_relation = [] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'fleet_contract_types';
        parent::__construct($attributes);
    }




}