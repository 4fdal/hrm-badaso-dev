<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOffType extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "is_create_calendar", "is_active", "color", "company_id", "name", "payroll_code", "take_time_off_types", "responsible_user_id", "allocation_types", "allocation_validation_types", "validity_start", "validity_stop", "time_off_validation_types"] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'data_types';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Uasoft\Badaso\Models\Company::class); }
    public function responsibleUser(){ return $this->belongsTo(Uasoft\Badaso\Models\BadasoUser::class); }

}