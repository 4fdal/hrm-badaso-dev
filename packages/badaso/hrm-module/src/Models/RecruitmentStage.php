<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentStage extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "sequnce"] ;

    public $public_data_rows = [['name','varchar'],['sequnce','int']] ;

    public $belongs_relation = [] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'recruitment_stages';
        parent::__construct($attributes);
    }




}