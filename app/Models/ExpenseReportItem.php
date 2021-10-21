<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportItem extends Model
{
    use HasFactory;

    protected $table = "expense_report_items" ;
    protected $fillable = [ "expense_reports_company_id", "expense_report_id"] ;
}