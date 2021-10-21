<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDistributionInvoice extends Model
{
    use HasFactory;

    protected $table = "accounting_distribution_invoices" ;
    protected $fillable = [ "accounting_tax_id", "percent", "base_on", "account_id", "tax_grids", "is_close_entry"] ;
}