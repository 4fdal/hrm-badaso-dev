<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCurrentAccountTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "tax_account_payables", "account_tag_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function taxAccountPayables(){ return $this->belongsTo(Uasoft\Badaso\Models\TaxAccountPayable::class); }
    public function accountTag(){ return $this->belongsTo(Uasoft\Badaso\Models\AccountTag::class); }

}