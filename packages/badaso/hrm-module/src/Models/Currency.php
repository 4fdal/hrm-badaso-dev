<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "sysmbol", "rounding", "decimal_place", "is_active", "position", "currency_unit_label", "currency_subunit_label"] ;

    public $public_data_rows = [['name','varchar'],['sysmbol','varchar'],['rounding','double'],['decimal_place','int'],['is_active','boolean'],['position','enum'],['currency_unit_label','varchar'],['currency_subunit_label','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'currency_id', "references" => 'id', "on" => 'countries'],["foreign" => 'currency_id', "references" => 'id', "on" => 'companies'],["foreign" => 'currency_id', "references" => 'id', "on" => 'lunch_cashmoves'],["foreign" => 'currency_id', "references" => 'id', "on" => 'lunch_orders'],["foreign" => 'currency_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'currency_id', "references" => 'id', "on" => 'partner_banks'],["foreign" => 'currency_id', "references" => 'id', "on" => 'account_journals']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'currencies';
        parent::__construct($attributes);
    }



    public function currencyCountries(){ return $this->hasMany(Country::class, "currency_id"); }
    public function currencyCompanies(){ return $this->hasMany(Company::class, "currency_id"); }
    public function currencyLunchCashmoves(){ return $this->hasMany(LunchCashmove::class, "currency_id"); }
    public function currencyLunchOrders(){ return $this->hasMany(LunchOrder::class, "currency_id"); }
    public function currencyAccounts(){ return $this->hasMany(Account::class, "currency_id"); }
    public function currencyPartnerBanks(){ return $this->hasMany(PartnerBank::class, "currency_id"); }
    public function currencyAccountJournals(){ return $this->hasMany(AccountJournal::class, "currency_id"); }

}