<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'category';
    public $timestamps = false;
    public $incrementing = false;


    public static function add($pid, $pname, $name)
    {
        $data['pid'] = $pid;
        $data['pname'] = $pname;
        $data['name'] = $name;
        $data['description'] = $name;
        self::insert($data);
    }
}