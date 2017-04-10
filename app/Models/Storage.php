<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model {

    protected $table = 'storage';

    protected $fillable = [
        'xinghao', 'material_name', 'store_place','storage_num','category_id','remark'
    ];
}