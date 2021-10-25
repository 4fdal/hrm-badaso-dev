<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentSource extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "source", "recruitment_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function recruitment(){ return $this->belongsTo(Uasoft\Badaso\Models\Recruitment::class); }

}