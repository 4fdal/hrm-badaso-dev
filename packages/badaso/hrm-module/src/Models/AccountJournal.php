<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountJournal extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "code", "is_active", "type", "default_account_id", "payment_debit_account_id", "payment_credit_account_id", "suspensi_account_id", "sequnce", "invoice_reference_type", "invoice_reference_model", "currency_id", "company_id", "is_refund_squence", "is_least_one_inbound", "is_least_one_outbound", "profit_account_id", "lost_account_id", "partner_bank_id"] ;

    public $public_data_rows = [['name','varchar'],['code','varchar'],['is_active','boolean'],['type','enum'],['default_account_id','int'],['payment_debit_account_id','int'],['payment_credit_account_id','int'],['suspensi_account_id','int'],['sequnce','int'],['invoice_reference_type','varchar'],['invoice_reference_model','varchar'],['currency_id','int'],['company_id','int'],['is_refund_squence','boolean'],['is_least_one_inbound','boolean'],['is_least_one_outbound','boolean'],['profit_account_id','int'],['lost_account_id','int'],['partner_bank_id','int']] ;

    public $belongs_relation = [["foreign" => 'default_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'payment_debit_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'payment_credit_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'suspensi_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies'],["foreign" => 'profit_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'lost_account_id', "references" => 'id', "on" => 'accounts'],["foreign" => 'partner_bank_id', "references" => 'id', "on" => 'partner_banks']] ;

    public $many_relation = [["foreign" => 'account_journal_id', "references" => 'id', "on" => 'tax_current_account_journals']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'account_journals';
        parent::__construct($attributes);
    }

    public function defaultAccount(){ return $this->belongsTo(Account::class); }
    public function paymentDebitAccount(){ return $this->belongsTo(Account::class); }
    public function paymentCreditAccount(){ return $this->belongsTo(Account::class); }
    public function suspensiAccount(){ return $this->belongsTo(Account::class); }
    public function currency(){ return $this->belongsTo(Currency::class); }
    public function company(){ return $this->belongsTo(Company::class); }
    public function profitAccount(){ return $this->belongsTo(Account::class); }
    public function lostAccount(){ return $this->belongsTo(Account::class); }
    public function partnerBank(){ return $this->belongsTo(PartnerBank::class); }


    public function accountJournalTaxCurrentAccountJournals(){ return $this->hasMany(TaxCurrentAccountJournal::class,"account_journal_id"); }

}