<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "job_id", "is_favorite", "no_of_application", "no_of_to_recruit", "no_of_new_application", "color"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function job(){ return $this->belongsTo(Uasoft\Badaso\Models\Job::class); }

}