<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "currency_id", "code", "is_deprecated", "account_type_id", "internal_type", "internal_global", "is_reconcile", "note", "company_id", "account_group_id", "root_id", "is_off_balance"] ;

    public $public_data_rows = [['name','varchar'],['currency_id','int'],['code','varchar'],['is_deprecated','boolean'],['account_type_id','int'],['internal_type','enum'],['internal_global','varchar'],['is_reconcile','boolean'],['note','text'],['company_id','int'],['account_group_id','int'],['root_id','boolean'],['is_off_balance','boolean']] ;

    public $belongs_relation = [["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies'],["foreign" => 'account_type_id', "references" => 'id', "on" => 'account_types'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'account_group_id', "references" => 'id', "on" => 'account_groups']] ;

    public $many_relation = [["foreign" => 'default_account_id', "references" => 'id', "on" => 'account_journals'],["foreign" => 'payment_debit_account_id', "references" => 'id', "on" => 'account_journals'],["foreign" => 'payment_credit_account_id', "references" => 'id', "on" => 'account_journals'],["foreign" => 'suspensi_account_id', "references" => 'id', "on" => 'account_journals'],["foreign" => 'profit_account_id', "references" => 'id', "on" => 'account_journals'],["foreign" => 'lost_account_id', "references" => 'id', "on" => 'account_journals']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'accounts';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Currency::class); }
    public function accountType(){ return $this->belongsTo(AccountType::class); }
    public function company(){ return $this->belongsTo(Company::class); }
    public function accountGroup(){ return $this->belongsTo(AccountGroup::class); }


    public function defaultAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"default_account_id"); }
    public function paymentDebitAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"payment_debit_account_id"); }
    public function paymentCreditAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"payment_credit_account_id"); }
    public function suspensiAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"suspensi_account_id"); }
    public function profitAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"profit_account_id"); }
    public function lostAccountAccountJournals(){ return $this->hasMany(AccountJournal::class,"lost_account_id"); }

}