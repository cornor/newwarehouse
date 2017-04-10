<?php

namespace App\Http\Controllers;

use App\Logic\CategoryLogic;
use App\Models\Storage;
use Auth;
use Hash;
use Illuminate\Http\Request;
use MessageAlert;
use UserLog;

class StorageController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $storages = Storage::all();
        $categorys = CategoryLogic::getCategorys();
        foreach ($storages as $v) {
            $v->category_name = isset($categorys[$v->category_id]) ? $categorys[$v->category_id]->name : '';
        }
        $data = array('page_title' => '库存管理', 'page_description' => '',
            'storages' => $storages);
        return view('storage.list', $data);
    }
}
