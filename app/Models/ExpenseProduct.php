<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseProduct extends Model
{
    use HasFactory;

    protected $table = "expense_products" ;
    protected $fillable = [ "name", "cost", "internal_reference", "company_id", "invoice_policy", "re_invoice_exoense", "image_path"] ;
}