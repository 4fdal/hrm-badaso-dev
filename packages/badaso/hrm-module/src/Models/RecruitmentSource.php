<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentSource extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "source", "recruitment_id"] ;

    public $public_data_rows = [['source','varchar'],['recruitment_id','int']] ;

    public $belongs_relation = [["foreign" => 'recruitment_id', "references" => 'id', "on" => 'recruitments']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'recruitment_sources';
        parent::__construct($attributes);
    }

    public function recruitment(){ return $this->belongsTo(Recruitment::class); }



}