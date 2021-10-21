<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $table = "account_groups" ;
    protected $fillable = [ "parent_path", "name", "code_prefix_start", "code_prefix_end", "company_id"] ;
}