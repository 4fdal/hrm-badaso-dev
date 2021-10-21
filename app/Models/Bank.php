<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = "banks" ;
    protected $fillable = [ "name", "street1", "street2", "zip", "state_id", "company_id", "email", "phone", "is_active", "bic"] ;
}