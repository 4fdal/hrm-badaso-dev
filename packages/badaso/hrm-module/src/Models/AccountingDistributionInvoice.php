<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDistributionInvoice extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "accounting_tax_id", "percent", "base_on", "account_id", "tax_grids", "is_close_entry"] ;

    public $public_data_rows = [['accounting_tax_id','int'],['percent','double'],['base_on','enum'],['account_id','int'],['tax_grids','varchar'],['is_close_entry','boolean']] ;

    public $belongs_relation = [["foreign" => 'accounting_tax_id', "references" => 'id', "on" => 'accounting_taxes']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'accounting_distribution_invoices';
        parent::__construct($attributes);
    }

    public function accountingTax(){ return $this->belongsTo(AccountingTaxe::class, "accounting_tax_id"); }



}