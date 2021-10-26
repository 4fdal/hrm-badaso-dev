<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "job_id", "is_favorite", "no_of_application", "no_of_to_recruit", "no_of_new_application", "color"] ;

    public $public_data_rows = [['job_id','int'],['is_favorite','double'],['no_of_application','int'],['no_of_to_recruit','int'],['no_of_new_application','int'],['color','varchar']] ;

    public $belongs_relation = [["foreign" => 'job_id', "references" => 'id', "on" => 'jobs']] ;

    public $many_relation = [["foreign" => 'recruitment_id', "references" => 'id', "on" => 'recruitment_sources']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'recruitments';
        parent::__construct($attributes);
    }

    public function job(){ return $this->belongsTo(Job::class, "job_id"); }


    public function recruitmentRecruitmentSources(){ return $this->hasMany(RecruitmentSource::class, "recruitment_id"); }

}