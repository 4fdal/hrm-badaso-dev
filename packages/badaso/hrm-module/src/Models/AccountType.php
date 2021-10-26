<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "company_id", "include_initial_balence", "type", "internal_group", "note"] ;

    public $public_data_rows = [['name','varchar'],['company_id','int'],['include_initial_balence','boolean'],['type','enum'],['internal_group','enum'],['note','text']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'account_type_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'group_account_type_id', "references" => 'id', "on" => 'tax_account_payables']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'account_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function accountTypeAccounts(){ return $this->hasMany(Account::class, "account_type_id"); }
    public function groupAccountTypeTaxAccountPayables(){ return $this->hasMany(TaxAccountPayable::class, "group_account_type_id"); }

}