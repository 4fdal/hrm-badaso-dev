<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCurrentAccountTag extends Model
{
    use HasFactory;

    protected $table = "tax_current_account_tags" ;
    protected $fillable = [ "tax_account_payables", "account_tag_id"] ;
}