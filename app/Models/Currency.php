<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = "currencies" ;
    protected $fillable = [ "name", "sysmbol", "rounding", "decimal_place", "is_active", "position", "currency_unit_label", "currency_subunit_label"] ;
}