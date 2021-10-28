<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerBank extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "is_active", "acc_number", "sanitize_acc_number", "acc_holder_name", "partner_id", "bank_id", "sequnce", "currency_id", "company_id"] ;

    public $public_data_rows = [['is_active','boolean'],['acc_number','varchar'],['sanitize_acc_number','varchar'],['acc_holder_name','varchar'],['partner_id','int'],['bank_id','int'],['sequnce','int'],['currency_id','int'],['company_id','int']] ;

    public $belongs_relation = [["foreign" => 'partner_id', "references" => 'id', "on" => 'partners', "model_on" => Partner::class],["foreign" => 'bank_id', "references" => 'id', "on" => 'banks', "model_on" => Bank::class],["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies', "model_on" => Currency::class],["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class]] ;

    public $many_relation = [["foreign" => 'partner_bank_id', "references" => 'id', "on" => 'account_journals', "model_on" => AccountJournal::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'partner_banks';
        parent::__construct($attributes);
    }

    public function partner(){ return $this->belongsTo(Partner::class, "partner_id"); }
    public function bank(){ return $this->belongsTo(Bank::class, "bank_id"); }
    public function currency(){ return $this->belongsTo(Currency::class, "currency_id"); }
    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function partnerBankAccountJournals(){ return $this->hasMany(AccountJournal::class, "partner_bank_id"); }

}