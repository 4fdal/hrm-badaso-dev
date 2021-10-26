<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "street1", "street2", "zip", "state_id", "company_id", "email", "phone", "is_active", "bic"] ;

    public $public_data_rows = [['name','varchar'],['street1','varchar'],['street2','varchar'],['zip','varchar'],['state_id','int'],['company_id','int'],['email','varchar'],['phone','varchar'],['is_active','boolean'],['bic','varchar']] ;

    public $belongs_relation = [["foreign" => 'state_id', "references" => 'id', "on" => 'states'],["foreign" => 'company_id', "references" => 'id', "on" => 'companies']] ;

    public $many_relation = [["foreign" => 'bank_id', "references" => 'id', "on" => 'partner_banks']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'banks';
        parent::__construct($attributes);
    }

    public function state(){ return $this->belongsTo(State::class); }
    public function company(){ return $this->belongsTo(Company::class); }


    public function bankPartnerBanks(){ return $this->hasMany(PartnerBank::class,"bank_id"); }

}