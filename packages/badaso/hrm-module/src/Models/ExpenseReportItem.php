<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportItem extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "expense_reports_company_id", "expense_report_id"] ;

    public $public_data_rows = [['expense_reports_company_id','int'],['expense_report_id','int']] ;

    public $belongs_relation = [["foreign" => 'expense_reports_company_id', "references" => 'id', "on" => 'expense_reports_companyes'],["foreign" => 'expense_report_id', "references" => 'id', "on" => 'expense_reports']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_report_items';
        parent::__construct($attributes);
    }

    public function expenseReportsCompany(){ return $this->belongsTo(ExpenseReportsCompanye::class, "expense_reports_company_id"); }
    public function expenseReport(){ return $this->belongsTo(ExpenseReport::class, "expense_report_id"); }



}