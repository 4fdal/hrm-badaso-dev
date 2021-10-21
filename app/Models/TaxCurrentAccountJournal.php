<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCurrentAccountJournal extends Model
{
    use HasFactory;

    protected $table = "tax_current_account_journals" ;
    protected $fillable = [ "tax_account_payables", "account_journal_id"] ;
}