<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTag extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "name", "applicability", "is_active", "country_id"] ;

    public $public_data_rows = [['name','varchar'],['applicability','enum'],['is_active','boolean'],['country_id','int']] ;

    public $belongs_relation = [["foreign" => 'country_id', "references" => 'id', "on" => 'countries']] ;

    public $many_relation = [["foreign" => 'account_tag_id', "references" => 'id', "on" => 'tax_current_account_tags']] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'account_tags';
        parent::__construct($attributes);
    }

    public function country(){ return $this->belongsTo(Country::class); }


    public function accountTagTaxCurrentAccountTags(){ return $this->hasMany(TaxCurrentAccountTag::class,"account_tag_id"); }

}