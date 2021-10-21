<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTag extends Model
{
    use HasFactory;

    protected $table = "employee_tags" ;
    protected $fillable = [ "employee_id", "employee_categorie_id"] ;
}