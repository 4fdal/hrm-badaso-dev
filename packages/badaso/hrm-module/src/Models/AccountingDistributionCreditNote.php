<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDistributionCreditNote extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "accounting_tax_id", "percent", "base_on", "account_id", "tax_grids", "is_close_entry"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function accountingTax(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountingTaxe::class); }

}