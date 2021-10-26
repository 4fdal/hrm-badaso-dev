<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "cost", "internal_reference", "company_id", "invoice_policy", "re_invoice_exoense", "image_path"] ;

    public $public_data_rows = [['name','varchar'],['cost','double'],['internal_reference','varchar'],['company_id','int'],['invoice_policy','enum'],['re_invoice_exoense','enum'],['image_path','varchar']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'expense_product_id', "references" => 'id', "on" => 'expense_vendor_accounting_tax'],["foreign" => 'expense_product_id', "references" => 'id', "on" => 'expense_customer_accounting_tax'],["foreign" => 'expense_product_id', "references" => 'id', "on" => 'expense_reports']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_products';
        parent::__construct($attributes);
    }



    public function expenseProductExpenseVendorAccountingTax(){ return $this->hasMany(ExpenseVendorAccountingTa::class, "expense_product_id"); }
    public function expenseProductExpenseCustomerAccountingTax(){ return $this->hasMany(ExpenseCustomerAccountingTa::class, "expense_product_id"); }
    public function expenseProductExpenseReports(){ return $this->hasMany(ExpenseReport::class, "expense_product_id"); }

}