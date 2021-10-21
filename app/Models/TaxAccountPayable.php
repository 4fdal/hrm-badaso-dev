<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxAccountPayable extends Model
{
    use HasFactory;

    protected $table = "tax_account_payables" ;
    protected $fillable = [ "code", "group_account_type_id", "is_deprecated", "default_account_tax_id"] ;
}