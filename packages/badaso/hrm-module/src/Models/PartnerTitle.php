<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerTitle extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "shortcut"] ;

    public $public_data_rows = [['name','varchar'],['shortcut','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'partner_title_id', "references" => 'id', "on" => 'company_contacts']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'partner_titles';
        parent::__construct($attributes);
    }



    public function partnerTitleCompanyContacts(){ return $this->hasMany(CompanyContact::class, "partner_title_id"); }

}