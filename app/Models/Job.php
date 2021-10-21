<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = "jobs" ;
    protected $fillable = [ "name", "no_of_employee", "no_of_recruitment", "no_of_hired_employee", "reqruitment", "departement_id", "company_id", "description", "state", "address_id", "manager_id"] ;
}