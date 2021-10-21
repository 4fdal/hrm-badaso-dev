<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportsCompanye extends Model
{
    use HasFactory;

    protected $table = "expense_reports_companyes" ;
    protected $fillable = [ "report_summary", "employee_id", "manager_user_id", "paid_by", "company_id", "expense_journal"] ;
}