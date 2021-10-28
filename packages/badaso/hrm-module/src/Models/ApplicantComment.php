<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantComment extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "applicant_id", "user_id", "message", "attachments"] ;

    public $public_data_rows = [['applicant_id','int'],['user_id','int'],['message','text'],['attachments','text']] ;

    public $belongs_relation = [["foreign" => 'applicant_id', "references" => 'id', "on" => 'applicants', "model_on" => Applicant::class],["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'applicant_comments';
        parent::__construct($attributes);
    }

    public function applicant(){ return $this->belongsTo(Applicant::class, "applicant_id"); }
    public function user(){ return $this->belongsTo(BadasoUser::class, "user_id"); }



}