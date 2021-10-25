<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTaxe extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "type_tax_use", "tax_scope", "amount_type", "is_active", "company_id", "sequnce", "amount", "description"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}