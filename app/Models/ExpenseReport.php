<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    use HasFactory;

    protected $table = "expense_reports" ;
    protected $fillable = [ "description", "expense_product_id", "unit_price", "quantity", "total", "amount_due", "paid_by", "bill_reference", "expense_date", "employee_id", "company_id", "note", "state_report", "register_payment_id"] ;
}