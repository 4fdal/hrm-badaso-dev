<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentSource extends Model
{
    use HasFactory;

    protected $table = "recruitment_sources" ;
    protected $fillable = [ "source", "recruitment_id"] ;
}