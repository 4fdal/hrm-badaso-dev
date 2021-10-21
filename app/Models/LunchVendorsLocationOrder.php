<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchVendorsLocationOrder extends Model
{
    use HasFactory;

    protected $table = "lunch_vendors_location_orders" ;
    protected $fillable = [ "lunch_vendor_id", "lunch_locations_id"] ;
}