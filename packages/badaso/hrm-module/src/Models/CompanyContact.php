<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "type", "name", "partner_title_id", "job_title", "email", "phone", "mobile", "notes", "street1", "street2", "city", "state_id", "zip", "country_id", "image_path"] ;

    public $public_data_rows = [['type','enum'],['name','varchar'],['partner_title_id','int'],['job_title','varchar'],['email','varchar'],['phone','varchar'],['mobile','varchar'],['notes','text'],['street1','varchar'],['street2','varchar'],['city','varchar'],['state_id','int'],['zip','varchar'],['country_id','int'],['image_path','varchar']] ;

    public $belongs_relation = [["foreign" => 'partner_title_id', "references" => 'id', "on" => 'partner_titles'],["foreign" => 'state_id', "references" => 'id', "on" => 'states'],["foreign" => 'country_id', "references" => 'id', "on" => 'countries']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'company_contacts';
        parent::__construct($attributes);
    }

    public function partnerTitle(){ return $this->belongsTo(PartnerTitle::class); }
    public function state(){ return $this->belongsTo(State::class); }
    public function country(){ return $this->belongsTo(Country::class); }



}