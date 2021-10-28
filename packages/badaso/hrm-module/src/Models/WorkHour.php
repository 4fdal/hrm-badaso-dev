<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHour extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "work_id", "name", "day_of_week", "day_period", "work_from", "work_to", "start_date", "end_date"] ;

    public $public_data_rows = [['work_id','int'],['name','varchar'],['day_of_week','varchar'],['day_period','varchar'],['work_from','time'],['work_to','time'],['start_date','datetime'],['end_date','datetime']] ;

    public $belongs_relation = [["foreign" => 'work_id', "references" => 'id', "on" => 'workes', "model_on" => Worke::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'work_hours';
        parent::__construct($attributes);
    }

    public function work(){ return $this->belongsTo(Worke::class, "work_id"); }



}