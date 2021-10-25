<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantComment extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "applicant_id", "user_id", "message", "attachments"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function applicant(){ return $this->belongsTo(Uasoft\Badaso\Models\Applicant::class); }
    public function user(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}