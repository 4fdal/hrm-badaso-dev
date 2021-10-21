<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerBank extends Model
{
    use HasFactory;

    protected $table = "partner_banks" ;
    protected $fillable = [ "is_active", "acc_number", "sanitize_acc_number", "acc_holder_name", "partner_id", "bank_id", "sequnce", "currency_id", "company_id"] ;
}