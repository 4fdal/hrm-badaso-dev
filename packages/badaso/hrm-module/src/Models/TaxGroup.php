<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxGroup extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "current_tax_account_payable_id", "advanced_tax_account_payable_id", "sequnce", "receiver_current_tax_account_payable_id"] ;

    public $public_data_rows = [['current_tax_account_payable_id','int'],['advanced_tax_account_payable_id','int'],['sequnce','int'],['receiver_current_tax_account_payable_id','int']] ;

    public $belongs_relation = [["foreign" => 'current_tax_account_payable_id', "references" => 'id', "on" => 'tax_account_payables'],["foreign" => 'advanced_tax_account_payable_id', "references" => 'id', "on" => 'tax_account_payables'],["foreign" => 'receiver_current_tax_account_payable_id', "references" => 'id', "on" => 'tax_account_payables']] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'tax_groups';
        parent::__construct($attributes);
    }

    public function currentTaxAccountPayable(){ return $this->belongsTo(TaxAccountPayable::class, "current_tax_account_payable_id"); }
    public function advancedTaxAccountPayable(){ return $this->belongsTo(TaxAccountPayable::class, "advanced_tax_account_payable_id"); }
    public function receiverCurrentTaxAccountPayable(){ return $this->belongsTo(TaxAccountPayable::class, "receiver_current_tax_account_payable_id"); }



}