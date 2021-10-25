<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseReportsCompanye extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "report_summary", "employee_id", "manager_user_id", "paid_by", "company_id", "expense_journal"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }


}