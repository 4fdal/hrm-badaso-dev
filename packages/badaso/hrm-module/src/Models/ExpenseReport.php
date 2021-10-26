<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "description", "expense_product_id", "unit_price", "quantity", "total", "amount_due", "paid_by", "bill_reference", "expense_date", "employee_id", "company_id", "note", "state_report", "register_payment_id"] ;

    public $public_data_rows = [['description','text'],['expense_product_id','int'],['unit_price','double'],['quantity','double'],['total','double'],['amount_due','double'],['paid_by','enum'],['bill_reference','varchar'],['expense_date','date'],['employee_id','int'],['company_id','int'],['note','text'],['state_report','enum'],['register_payment_id','int']] ;

    public $belongs_relation = [["foreign" => 'expense_product_id', "references" => 'id', "on" => 'expense_products'],["foreign" => 'employee_id', "references" => 'id', "on" => 'employees'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'expense_report_id', "references" => 'id', "on" => 'expense_report_items']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_reports';
        parent::__construct($attributes);
    }

    public function expenseProduct(){ return $this->belongsTo(ExpenseProduct::class); }
    public function employee(){ return $this->belongsTo(Employee::class); }
    public function company(){ return $this->belongsTo(Company::class); }


    public function expenseReportExpenseReportItems(){ return $this->hasMany(ExpenseReportItem::class,"expense_report_id"); }

}