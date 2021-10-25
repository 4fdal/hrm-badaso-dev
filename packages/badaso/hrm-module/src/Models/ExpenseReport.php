<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReport extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "description", "expense_product_id", "unit_price", "quantity", "total", "amount_due", "paid_by", "bill_reference", "expense_date", "employee_id", "company_id", "note", "state_report", "register_payment_id"] ;

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
    public function employee(){ return $this->belongsTo(Uasoft\Badaso\Models\Employee::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}