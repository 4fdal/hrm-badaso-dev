<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;

    protected $table = "company_contacts" ;
    protected $fillable = [ "type", "name", "partner_title_id", "job_title", "email", "phone", "mobile", "notes", "street1", "street2", "city", "state_id", "zip", "country_id", "image_path"] ;
}