<?php

namespace App\Http\Controllers;

use App\Logic\CategoryLogic;
use App\Models\MaterialIn;
use App\Models\Storage;
use Auth;
use Hash;
use Illuminate\Http\Request;
use MessageAlert;
use UserLog;

class MaterialInController extends Controller
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
            $indatas = MaterialIn::where('material_name', 'like', '%'.$query.'%')->take(100)->get()->sortByDesc('in_time');
        } else {
            $indatas = MaterialIn::all()->sortByDesc('in_time')->take(100);
        }
        $categorys = CategoryLogic::getCategorys();
        foreach ($indatas as $indata) {
            $indata->category_name = isset($categorys[$indata->category_id]) ? $categorys[$indata->category_id]->name : '';
        }
        $data = array('page_title' => '入库记录', 'page_description' => '增加，搜索入库记录',
            'indatas' => $indatas, 'query' => $query);
        return view('materialin.list', $data);
    }

    public function create(Request $request)
    {
        $categorys = CategoryLogic::formatCategorySelect();
        $user = $request->user();
        $data = [
            'page_title' => '添加入库',
            'page_description' => '增加入库记录',
            'categorys' => $categorys,
            'user' => $user
        ];
        return view('materialin.create', $data);
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['in_time'] = date('Y-m-d H:i:s');
        MaterialIn::create($data);

        $storage = Storage::where('xinghao', $request->input('xinghao'))->first();
        if ($storage) {
            $storage->storage_num += $request->input('in_num');
            $storage->store_place = $request->input('store_place');
            $storage->remark = $request->input('remark');
            $storage->update();
        } else {
            $data['storage_num'] = $data['in_num'];
            Storage::create($data);
        }

        app('messageAlert')->store('保存成功', MessageAlert::SUCCESS, '入库记录增加成功。');
        return redirect()->route('materialin.index');
    }
}
