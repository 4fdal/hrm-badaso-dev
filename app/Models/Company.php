<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "companies" ;
    protected $fillable = [ "name", "parent_id", "currency_id", "sequnce", "partner_id", "report_header", "report_footer", "img_logo_path", "email", "phone"] ;
}