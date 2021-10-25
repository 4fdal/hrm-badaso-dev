<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "type", "name", "partner_title_id", "job_title", "email", "phone", "mobile", "notes", "street1", "street2", "city", "state_id", "zip", "country_id", "image_path"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function partnerTitle(){ return $this->belongsTo(Uasoft\Badaso\Models\PartnerTitle::class); }
    public function state(){ return $this->belongsTo(Uasoft\Badaso\Models\State::class); }
    public function country(){ return $this->belongsTo(Uasoft\Badaso\Models\Country::class); }

}