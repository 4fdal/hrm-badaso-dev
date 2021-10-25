<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxAccountPayable extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "code", "group_account_type_id", "is_deprecated", "default_account_tax_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function groupAccountType(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountType::class); }
    public function defaultAccountTax(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountTaxe::class); }

}