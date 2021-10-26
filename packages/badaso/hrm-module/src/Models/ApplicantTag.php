<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "applicant_id", "applicant_category_id"] ;

    public $public_data_rows = [['applicant_id','int'],['applicant_category_id','int']] ;

    public $belongs_relation = [["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicants'],["foreign" => 'applicant_category_id', "references" => 'id', "on" => 'applicant_categories']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'applicant_tags';
        parent::__construct($attributes);
    }

    public function applicant(){ return $this->belongsTo(Applicant::class); }
    public function applicantCategory(){ return $this->belongsTo(ApplicantCategory::class); }



}