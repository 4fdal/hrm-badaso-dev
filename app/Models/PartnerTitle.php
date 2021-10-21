<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerTitle extends Model
{
    use HasFactory;

    protected $table = "partner_titles" ;
    protected $fillable = [ "name", "shortcut"] ;
}