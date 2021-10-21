<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = "accounts" ;
    protected $fillable = [ "name", "currency_id", "code", "is_deprecated", "account_type_id", "internal_type", "internal_global", "is_reconcile", "note", "company_id", "account_group_id", "root_id", "is_off_balance"] ;
}