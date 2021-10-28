<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportsCompanye extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "report_summary", "employee_id", "manager_user_id", "paid_by", "company_id", "expense_journal"] ;

    public $public_data_rows = [['report_summary','varchar'],['employee_id','int'],['manager_user_id','int'],['paid_by','enum'],['company_id','int'],['expense_journal','enum']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'expense_reports_company_id', "references" => 'id', "on" => 'expense_report_items', "model_on" => ExpenseReportItem::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_reports_companyes';
        parent::__construct($attributes);
    }



    public function expenseReportsCompanyExpenseReportItems(){ return $this->hasMany(ExpenseReportItem::class, "expense_reports_company_id"); }

}