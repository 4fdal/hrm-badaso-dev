<?php
namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicantRefuseType extends Model {
    protected $table = null ;
    protected $fillable = ["name"] ;

    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix . 'applicant_refuse_types';
        parent::__construct($attributes);
    }

    public function applicantRefuse(){
        return $this->hasMany ;
    }
}
