<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportItem extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "expense_reports_company_id", "expense_report_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function expenseReportsCompany(){ return $this->belongsTo(Uasoft\Badaso\Models\ExpenseReportsCompanye::class); }
    public function expenseReport(){ return $this->belongsTo(Uasoft\Badaso\Models\ExpenseReport::class); }

}