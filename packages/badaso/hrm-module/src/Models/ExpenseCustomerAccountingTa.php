<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCustomerAccountingTa extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "expense_product_id", "accounting_tax_id"] ;

    public $public_data_rows = [['expense_product_id','int'],['accounting_tax_id','int']] ;

    public $belongs_relation = [["foreign" => 'expense_product_id', "references" => 'id', "on" => 'expense_products'],["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'accounting_taxes']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_customer_accounting_tax';
        parent::__construct($attributes);
    }

    public function expenseProduct(){ return $this->belongsTo(ExpenseProduct::class, "expense_product_id"); }
    public function accountingTax(){ return $this->belongsTo(AccountingTaxe::class, "accounting_tax_id"); }



}