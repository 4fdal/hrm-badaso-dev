<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "code", "currency_id", "phone_code", "name_position", "vat_label"] ;

    public $public_data_rows = [['name','varchar'],['code','varchar'],['currency_id','int'],['phone_code','varchar'],['name_position','varchar'],['vat_label','varchar']] ;

    public $belongs_relation = [["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies']] ;

    public $many_relation = [["foreign" => 'country_id', "references" => 'id', "on" => 'states'],["foreign" => 'country_id', "references" => 'id', "on" => 'employees'],["foreign" => 'country_of_birth_id', "references" => 'id', "on" => 'employees'],["foreign" => 'country_id', "references" => 'id', "on" => 'company_contacts'],["foreign" => 'country_id', "references" => 'id', "on" => 'account_tags']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'countries';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Currency::class); }


    public function countryStates(){ return $this->hasMany(State::class,"country_id"); }
    public function countryEmployees(){ return $this->hasMany(Employee::class,"country_id"); }
    public function countryOfBirthEmployees(){ return $this->hasMany(Employee::class,"country_of_birth_id"); }
    public function countryCompanyContacts(){ return $this->hasMany(CompanyContact::class,"country_id"); }
    public function countryAccountTags(){ return $this->hasMany(AccountTag::class,"country_id"); }

}