<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingTaxe extends Model
{
    use HasFactory;

    protected $table = "accounting_taxes" ;
    protected $fillable = [ "tax_name", "tax_computation", "is_active", "tax_type", "tax_score", "amount", "accountig_type", "label_invoice", "taxes_group_id", "is_include_price", "is_subsequent_tax"] ;
}