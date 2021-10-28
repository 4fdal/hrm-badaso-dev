<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCurrentAccountJournal extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "tax_account_payables", "account_journal_id"] ;

    public $public_data_rows = [['tax_account_payables','int'],['account_journal_id','int']] ;

    public $belongs_relation = [["foreign" => 'tax_account_payables', "references" => 'id', "on" => 'tax_account_payables', "model_on" => TaxAccountPayable::class],["foreign" => 'account_journal_id', "references" => 'id', "on" => 'account_journals', "model_on" => AccountJournal::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'tax_current_account_journals';
        parent::__construct($attributes);
    }

    public function taxAccountPayables(){ return $this->belongsTo(TaxAccountPayable::class, "tax_account_payables"); }
    public function accountJournal(){ return $this->belongsTo(AccountJournal::class, "account_journal_id"); }



}