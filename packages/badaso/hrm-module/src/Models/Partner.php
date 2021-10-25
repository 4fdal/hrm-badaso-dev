<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "company_id", "name", "display_name", "parent_id", "lang", "timezone", "vat", "website", "credit_limit", "is_active", "type", "street1", "street2", "zip", "city", "state_id", "country_id", "latitude", "longitute", "email", "phone", "mobile", "is_comapany", "industry_id", "commercial_partner_id", "commercial_company_name", "company_name"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function parent(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }
    public function industry(){ return $this->belongsTo(Uasoft\Badaso\Models\Industry::class); }
    public function commercialPartner(){ return $this->belongsTo(Uasoft\Badaso\Models\Partner::class); }
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }

}