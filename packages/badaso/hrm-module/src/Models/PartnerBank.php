<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerBank extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "is_active", "acc_number", "sanitize_acc_number", "acc_holder_name", "partner_id", "bank_id", "sequnce", "currency_id", "company_id"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function partner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }
    public function bank(){ return $this->belongsTo(Uasoft\Badaso\Models\Bank::class); }
    public function currency(){ return $this->belongsTo(Uasoft\Badaso\Models\Currency::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}