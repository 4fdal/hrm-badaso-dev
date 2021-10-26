<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "full_name", "is_active"] ;

    public $public_data_rows = [['name','varchar'],['full_name','varchar'],['is_active','boolean']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'industry_id', "references" => 'id', "on" => 'partners']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'industries';
        parent::__construct($attributes);
    }



    public function industryPartners(){ return $this->hasMany(Partner::class,"industry_id"); }

}