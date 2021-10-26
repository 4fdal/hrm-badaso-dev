<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCategory extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "color"] ;

    public $public_data_rows = [['name','varchar'],['color','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'applicant_category_id', "references" => 'id', "on" => 'applicant_tags']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'applicant_categories';
        parent::__construct($attributes);
    }



    public function applicantCategoryApplicantTags(){ return $this->hasMany(ApplicantTag::class, "applicant_category_id"); }

}