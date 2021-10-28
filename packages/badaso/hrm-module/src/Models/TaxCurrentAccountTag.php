<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCurrentAccountTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "tax_account_payables", "account_tag_id"] ;

    public $public_data_rows = [['tax_account_payables','int'],['account_tag_id','int']] ;

    public $belongs_relation = [["foreign" => 'tax_account_payables', "references" => 'id', "on" => 'tax_account_payables', "model_on" => TaxAccountPayable::class],["foreign" => 'account_tag_id', "references" => 'id', "on" => 'account_tags', "model_on" => AccountTag::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'tax_current_account_tags';
        parent::__construct($attributes);
    }

    public function taxAccountPayables(){ return $this->belongsTo(TaxAccountPayable::class, "tax_account_payables"); }
    public function accountTag(){ return $this->belongsTo(AccountTag::class, "account_tag_id"); }



}