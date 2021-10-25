<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchVendor extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "partner_id", "company_id", "responsible_user_id", "send_by", "automatic_email_time", "is_recurrent_monday", "is_recurrent_tuesday", "is_recurrent_wednesday", "is_recurrent_thursday", "is_recurrent_friday", "is_recurrent_saturday", "is_recurrent_sunday", "timezone", "is_active", "moment", "delivery"] ;

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
    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function responsibleUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}