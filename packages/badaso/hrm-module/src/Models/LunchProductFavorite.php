<?php

namespace Uasoft\Badaso\Module\HRM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LunchProductFavorite extends Model
{
    use HasFactory;

    protected $table = null ;
    protected $fillable = [ "lunch_product_id", "user_id"] ;

    public $public_data_rows = [['lunch_product_id','int'],['user_id','int']] ;

    public $belongs_relation = [["foreign" => 'lunch_product_id', "references" => 'id', "on" => 'lunch_products', "model_on" => LunchProduct::class],["foreign" => 'user_id', "references" => 'id', "on" => 'badaso_users', "model_on" => BadasoUser::class]] ;

    public $many_relation = [] ;

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        $prefix = config('badaso.database.prefix');
        $this->table = $prefix.'lunch_product_favorites';
        parent::__construct($attributes);
    }

    public function lunchProduct(){ return $this->belongsTo(LunchProduct::class, "lunch_product_id"); }
    public function user(){ return $this->belongsTo(BadasoUser::class, "user_id"); }



}