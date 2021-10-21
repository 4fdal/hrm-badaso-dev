<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCustomerAccountingTa extends Model
{
    use HasFactory;

    protected $table = "expense_customer_accounting_tax" ;
    protected $fillable = [ "expense_product_id", "accounting_tax_id"] ;
}