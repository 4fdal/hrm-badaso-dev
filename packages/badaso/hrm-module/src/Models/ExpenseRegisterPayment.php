<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseRegisterPayment extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [] ;

    public $public_data_rows = [] ;

    public $belongs_relation = [] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'expense_register_payments';
        parent::__construct($attributes);
    }




}