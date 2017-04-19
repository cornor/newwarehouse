<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialOut extends Model {

    protected $table = 'material_out';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'xinghao', 'material_name','out_num', 'out_time','category_id','check_user','remark','danwei'
    ];
}