<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "parent_path", "name", "code_prefix_start", "code_prefix_end", "company_id"] ;

    public $public_data_rows = [['parent_path','varchar'],['name','varchar'],['code_prefix_start','varchar'],['code_prefix_end','varchar'],['company_id','int']] ;

    public $belongs_relation = [["foreign" => 'company_id', "references" => 'id', "on" => 'companies', "model_on" => Company::class]] ;

    public $many_relation = [["foreign" => 'account_group_id', "references" => 'id', "on" => 'accounts', "model_on" => Account::class]] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'account_groups';
        parent::__construct($attributes);
    }

    public function company(){ return $this->belongsTo(Company::class, "company_id"); }


    public function accountGroupAccounts(){ return $this->hasMany(Account::class, "account_group_id"); }

}
