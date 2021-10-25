<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "currency_id", "code", "is_deprecated", "account_type_id", "internal_type", "internal_global", "is_reconcile", "note", "company_id", "account_group_id", "root_id", "is_off_balance"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Uasoft\Badaso\Models\Currency::class); }
    public function accountType(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountType::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function accountGroup(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountGroup::class); }

}