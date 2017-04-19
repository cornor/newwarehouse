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
        $cateId = $request->input('cateId', 0);
        if (strlen($query) > 0 || $cateId > 0) {
            $query = urldecode($query);
            $conditions = [];
            if ($query) {
                $conditions[] = ['material_name', 'like', '%' . $query . '%'];
            }
            if ($cateId > 0) {
                $conditions[] = ['category_id', $cateId];
            }
            $storages = Storage::where($conditions)->get()->sortByDesc('updated_at')->take(100);
        } else {
            $storages = Storage::all()->sortByDesc('updated_at')->take(100);
        }
        $categorys = CategoryLogic::getCategorys();
        foreach ($storages as $v) {
            $v->category_name = isset($categorys[$v->category_id]) ? $categorys[$v->category_id]->name : '';
        }

        foreach ($storages as $storage) {
            $storage->baojing = $storage->xianding_num > 0 && $storage->storage_num < $storage->xianding_num ? 1 : 0;
            $storage->storage_num = $this->transferDanwei($storage->storage_num, $storage->danwei);
            $storage->xianding_num = $this->transferDanwei($storage->xianding_num, $storage->danwei);
        }

        $data = array('page_title' => '库存管理',
            'page_description' => '',
            'storages' => $storages,
            'query' => $query,
            'categorys' => CategoryLogic::formatCanNoneCategorySelect(),
            'cateId' => $cateId
        );
        return view('storage.list', $data);
    }
}
