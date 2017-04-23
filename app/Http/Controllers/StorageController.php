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
            $count = Storage::where($conditions)->count();
            $this->setDefaultPage($request, $count);
            $pageList = Storage::where($conditions)->paginate(parent::PAGE_NUM);
        } else {
            $count = Storage::count();
            $this->setDefaultPage($request, $count);
            $pageList = Storage::paginate(parent::PAGE_NUM);
        }
        $categorys = CategoryLogic::getCategorys();
        $storages = [];
        foreach ($pageList as $v) {
            $v->category_name = isset($categorys[$v->category_id]) ? $categorys[$v->category_id]->name : '';
            $storages[] = $v;
        }
        foreach ($storages as $storage) {
            $storage->baojing = $storage->xianding_num > 0 && $storage->storage_num < $storage->xianding_num ? 1 : 0;
            $storage->storage_num = $this->transferDanwei($storage->storage_num, $storage->danwei);
            $storage->xianding_num = $this->transferDanwei($storage->xianding_num, $storage->danwei);
        }
        $pageList->appends(['q' => $query, 'cateId' => $cateId])->links();
        $data = array('page_title' => '库存管理',
            'page_description' => '',
            'pageList' => $pageList,
            'storages' => $storages,
            'query' => $query,
            'cateId' => $cateId,
            'categorys' => CategoryLogic::formatCanNoneCategorySelect()
        );
        return view('storage.list', $data);
    }
}
