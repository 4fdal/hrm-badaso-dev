<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "applicant_id", "applicant_category_id"] ;

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
    public function applicantCategory(){ return $this->belongsTo(Uasoft\Badaso\Models\ApplicantCategory::class); }

}