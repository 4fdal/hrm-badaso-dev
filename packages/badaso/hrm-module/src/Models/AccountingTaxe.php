<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingTaxe extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "tax_name", "tax_computation", "is_active", "tax_type", "tax_score", "amount", "accountig_type", "label_invoice", "taxes_group_id", "is_include_price", "is_subsequent_tax"] ;

    public $public_data_rows = [['tax_name','varchar'],['tax_computation','enum'],['is_active','boolean'],['tax_type','enum'],['tax_score','enum'],['amount','double'],['accountig_type','enum'],['label_invoice','varchar'],['taxes_group_id','int'],['is_include_price','boolean'],['is_subsequent_tax','boolean']] ;

    public $belongs_relation = [] ;

    public $many_relation = [["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'accounting_distribution_invoices'],["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'accounting_distribution_credit_notes'],["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'expense_vendor_accounting_tax'],["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'expense_customer_accounting_tax']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'accounting_taxes';
        parent::__construct($attributes);
    }



    public function accountingTaxAccountingDistributionInvoices(){ return $this->hasMany(AccountingDistributionInvoice::class,"accounting_tax_id"); }
    public function accountingTaxAccountingDistributionCreditNotes(){ return $this->hasMany(AccountingDistributionCreditNote::class,"accounting_tax_id"); }
    public function accountingTaxExpenseVendorAccountingTax(){ return $this->hasMany(ExpenseVendorAccountingTa::class,"accounting_tax_id"); }
    public function accountingTaxExpenseCustomerAccountingTax(){ return $this->hasMany(ExpenseCustomerAccountingTa::class,"accounting_tax_id"); }

}