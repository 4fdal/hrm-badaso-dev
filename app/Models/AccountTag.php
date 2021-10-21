<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTag extends Model
{
    use HasFactory;

    protected $table = "account_tags" ;
    protected $fillable = [ "name", "applicability", "is_active", "country_id"] ;
}