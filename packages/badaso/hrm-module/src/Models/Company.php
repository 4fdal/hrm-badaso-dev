<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "parent_id", "currency_id", "sequnce", "partner_id", "report_header", "report_footer", "img_logo_path", "email", "phone"] ;

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
    public function parent(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function partner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }

}