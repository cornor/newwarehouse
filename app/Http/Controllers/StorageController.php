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
        $query = $request->input('q', '');
        $query = trim($query);
        if (strlen($query) > 0) {
            $query = urldecode($query);
            $storages = Storage::where('material_name', 'like', '%'.$query.'%')->get()->sortByDesc('updated_at')->take(100);
        } else {
            $storages = Storage::all()->sortByDesc('updated_at')->take(100);
        }
        $categorys = CategoryLogic::getCategorys();
        foreach ($storages as $v) {
            $v->category_name = isset($categorys[$v->category_id]) ? $categorys[$v->category_id]->name : '';
        }
        $data = array('page_title' => '库存管理', 'page_description' => '',
            'storages' => $storages, 'query' => $query);
        return view('storage.list', $data);
    }
}
