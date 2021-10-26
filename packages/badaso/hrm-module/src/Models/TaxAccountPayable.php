<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxAccountPayable extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "code", "group_account_type_id", "is_deprecated", "default_account_tax_id"] ;

    public $public_data_rows = [['code','varchar'],['group_account_type_id','int'],['is_deprecated','boolean'],['default_account_tax_id','int']] ;

    public $belongs_relation = [["foreign" => 'group_account_type_id', "references" => 'id', "on" => 'account_types'],["foreign" => 'default_account_tax_id', "references" => 'id', "on" => 'account_taxes']] ;

    public $many_relation = [["foreign" => 'tax_account_payables', "references" => 'id', "on" => 'tax_current_account_tags'],["foreign" => 'tax_account_payables', "references" => 'id', "on" => 'tax_current_account_journals'],["foreign" => 'current_tax_account_payable_id', "references" => 'id', "on" => 'tax_groups'],["foreign" => 'advanced_tax_account_payable_id', "references" => 'id', "on" => 'tax_groups'],["foreign" => 'receiver_current_tax_account_payable_id', "references" => 'id', "on" => 'tax_groups']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'tax_account_payables';
        parent::__construct($attributes);
    }

    public function groupAccountType(){ return $this->belongsTo(AccountType::class, "group_account_type_id"); }
    public function defaultAccountTax(){ return $this->belongsTo(AccountTaxe::class, "default_account_tax_id"); }


    public function taxAccountPayablesTaxCurrentAccountTags(){ return $this->hasMany(TaxCurrentAccountTag::class, "tax_account_payables"); }
    public function taxAccountPayablesTaxCurrentAccountJournals(){ return $this->hasMany(TaxCurrentAccountJournal::class, "tax_account_payables"); }
    public function currentTaxAccountPayableTaxGroups(){ return $this->hasMany(TaxGroup::class, "current_tax_account_payable_id"); }
    public function advancedTaxAccountPayableTaxGroups(){ return $this->hasMany(TaxGroup::class, "advanced_tax_account_payable_id"); }
    public function receiverCurrentTaxAccountPayableTaxGroups(){ return $this->hasMany(TaxGroup::class, "receiver_current_tax_account_payable_id"); }

}