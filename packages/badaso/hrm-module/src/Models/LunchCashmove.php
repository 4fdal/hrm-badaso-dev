<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchCashmove extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "currency_id", "user_id", "date", "amount", "description"] ;

    public $public_data_rows = [['currency_id','int'],['user_id','int'],['date','date'],['amount','double'],['description','text']] ;

    public $belongs_relation = [["foreign" => 'currency_id', "references" => 'id', "on" => 'currencies', "model_on" => Currency::class],["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_cashmoves';
        parent::__construct($attributes);
    }

    public function currency(){ return $this->belongsTo(Currency::class, "currency_id"); }
    public function user(){ return $this->belongsTo(BadasoUser::class, "user_id"); }



}