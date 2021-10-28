<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalTimeOff extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "worke_id", "reason", "start_date", "end_date"] ;

    public $public_data_rows = [['worke_id','int'],['reason','varchar'],['start_date','datetime'],['end_date','datetime']] ;

    public $belongs_relation = [["foreign" => 'worke_id', "references" => 'id', "on" => 'workes', "model_on" => Worke::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'global_time_offs';
        parent::__construct($attributes);
    }

    public function worke(){ return $this->belongsTo(Worke::class, "worke_id"); }



}