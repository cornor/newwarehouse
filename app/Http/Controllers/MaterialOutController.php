<?php

namespace App\Http\Controllers;

use App\Logic\CategoryLogic;
use App\Models\MaterialIn;
use App\Models\MaterialOut;
use App\Models\Storage;
use Auth;
use Hash;
use Illuminate\Http\Request;
use MessageAlert;
use UserLog;

class MaterialOutController extends Controller
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
        $outdatas = MaterialOut::all();
        $categorys = CategoryLogic::getCategorys();
        foreach ($outdatas as $indata) {
            $indata->category_name = isset($categorys[$indata->category_id]) ? $categorys[$indata->category_id]->name : '';
        }
        $data = array('page_title' => '出库管理', 'page_description' => '增加，搜索出库记录',
            'outdatas' => $outdatas);
        return view('materialout.list', $data);
    }

    public function create(Request $request)
    {
        $categorys = CategoryLogic::formatCategorySelect();
        $user = $request->user();
        $data = [
            'page_title' => '添加出库',
            'page_description' => '增加出库记录',
            'categorys' => $categorys,
            'user' => $user
        ];
        return view('materialout.create', $data);
    }

    public function store(Request $request) {
        $data = $request->all();
        $data['out_time'] = date('Y-m-d H:i:s');

        $storage = Storage::where('xinghao', $request->input('xinghao'))->first();

        if (!$storage || $storage->storage_num < $request->input('out_num')) {
            app('messageAlert')->store('出库失败', MessageAlert::DANGER, '库存数量不足。');
            return redirect()->route('materialout.index');
        }
        MaterialOut::create($data);
        $storage->storage_num -= $request->input('out_num');
        $storage->update();

        app('messageAlert')->store('保存成功', MessageAlert::SUCCESS, '出库记录增加成功。');
        return redirect()->route('materialout.index');
    }
}
