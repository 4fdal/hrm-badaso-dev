<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetsosSource extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name"] ;

    public $public_data_rows = [['name','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'metsos_source_id', "references" => 'id', "on" => 'applicants', "model_on" => Applicant::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'metsos_sources';
        parent::__construct($attributes);
    }



    public function metsosSourceApplicants(){ return $this->hasMany(Applicant::class, "metsos_source_id"); }

}