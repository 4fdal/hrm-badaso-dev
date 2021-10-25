<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxGroup extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "current_tax_account_payable_id", "advanced_tax_account_payable_id", "sequnce", "receiver_current_tax_account_payable_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function currentTaxAccountPayable(){ return $this->belongsTo(Uasoft\Badaso\Models\TaxAccountPayable::class); }
    public function advancedTaxAccountPayable(){ return $this->belongsTo(Uasoft\Badaso\Models\TaxAccountPayable::class); }
    public function receiverCurrentTaxAccountPayable(){ return $this->belongsTo(Uasoft\Badaso\Models\TaxAccountPayable::class); }

}