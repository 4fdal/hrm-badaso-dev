<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;

    protected $table = "account_types" ;
    protected $fillable = [ "name", "company_id", "include_initial_balence", "type", "internal_group", "note"] ;
}