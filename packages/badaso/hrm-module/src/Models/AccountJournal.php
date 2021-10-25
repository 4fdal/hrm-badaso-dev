<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountJournal extends Model
{
    use HasFactory;

    protected $table = null;
    protected $fillable = ["name", "code", "is_active", "type", "default_account_id", "payment_debit_account_id", "payment_credit_account_id", "suspensi_account_id", "sequnce", "invoice_reference_type", "invoice_reference_model", "currency_id", "company_id", "is_refund_squence", "is_least_one_inbound", "is_least_one_outbound", "profit_account_id", "lost_account_id", "partner_bank_id"];

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix . 'data_types';
        parent::__construct($attributes);
    }

    public function defaultAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function paymentDebitAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function paymentCreditAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function suspensiAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function currency()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Currency::class);
    }
    public function company()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Company::class);
    }
    public function profitAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function lostAccount()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\Account::class);
    }
    public function partnerBank()
    {
        return $this->belongsTo(Uasoft\Badaso\Models\PartnerBank::class);
    }
}
