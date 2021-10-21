<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxGroup extends Model
{
    use HasFactory;

    protected $table = "tax_groups" ;
    protected $fillable = [ "current_tax_account_payable_id", "advanced_tax_account_payable_id", "sequnce", "receiver_current_tax_account_payable_id"] ;
}