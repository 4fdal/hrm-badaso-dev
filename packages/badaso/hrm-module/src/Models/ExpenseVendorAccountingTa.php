<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseVendorAccountingTa extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "expense_product_id", "accounting_tax_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function expenseProduct(){ return $this->belongsTo(Uasoft\Badaso\Models\ExpenseProduct::class); }
    public function accountingTax(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountingTaxe::class); }

}