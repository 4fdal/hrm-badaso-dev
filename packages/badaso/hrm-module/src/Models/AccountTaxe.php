<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTaxe extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "type_tax_use", "tax_scope", "amount_type", "is_active", "company_id", "sequnce", "amount", "description"] ;

    public $public_data_rows = [['name','varchar'],['type_tax_use','enum'],['tax_scope','varchar'],['amount_type','varchar'],['is_active','boolean'],['company_id','int'],['sequnce','int'],['amount','double'],['description','text']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class]] ;

    public $many_relation = [["foreign" => 'default_account_tax_id', "references" => 'id', "on" => 'tax_account_payables', "model_on" => TaxAccountPayable::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'account_taxes';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function defaultAccountTaxTaxAccountPayables(){ return $this->hasMany(TaxAccountPayable::class, "default_account_tax_id"); }

}