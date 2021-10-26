<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "country_id", "code"] ;

    public $public_data_rows = [['name','varchar'],['country_id','int'],['code','varchar']] ;

    public $belongs_relation = [["foreign" => 'country_id', "references" => 'id', "on" => 'countries']] ;

    public $many_relation = [["foreign" => 'state_id', "references" => 'id', "on" => 'company_contacts'],["foreign" => 'state_id', "references" => 'id', "on" => 'banks']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'states';
        parent::__construct($attributes);
    }

    public function country(){ return $this->belongsTo(Country::class); }


    public function stateCompanyContacts(){ return $this->hasMany(CompanyContact::class,"state_id"); }
    public function stateBanks(){ return $this->hasMany(Bank::class,"state_id"); }

}