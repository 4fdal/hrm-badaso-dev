<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTaxe extends Model
{
    use HasFactory;

    protected $table = "account_taxes" ;
    protected $fillable = [ "name", "type_tax_use", "tax_scope", "amount_type", "is_active", "company_id", "sequnce", "amount", "description"] ;
}