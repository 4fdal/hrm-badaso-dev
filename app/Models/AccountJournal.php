<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountJournal extends Model
{
    use HasFactory;

    protected $table = "account_journals" ;
    protected $fillable = [ "name", "code", "is_active", "type", "default_account_id", "payment_debit_account_id", "payment_credit_account_id", "suspensi_account_id", "sequnce", "invoice_reference_type", "invoice_reference_model", "currency_id", "company_id", "is_refund_squence", "is_least_one_inbound", "is_least_one_outbound", "profit_account_id", "lost_account_id", "partner_bank_id"] ;
}