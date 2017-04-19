<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialIn extends Model {

    protected $table = 'material_in';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'xinghao', 'material_name', 'store_place','in_num', 'in_time','category_id','check_user','price',
        'remark','danwei'
    ];
}