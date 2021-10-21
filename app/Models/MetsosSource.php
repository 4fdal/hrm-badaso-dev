<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetsosSource extends Model
{
    use HasFactory;

    protected $table = "metsos_sources" ;
    protected $fillable = [ "name"] ;
}