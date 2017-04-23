<?php

namespace App\Http\Controllers;

use App\Logic\CategoryLogic;
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
            $count = MaterialOut::where($conditions)->count();
            $this->setDefaultPage($request, $count);
            $pageList = MaterialOut::where($conditions)->paginate(parent::PAGE_NUM);
        } else {
            $count = MaterialOut::count();
            $this->setDefaultPage($request, $count);
            $pageList = MaterialOut::paginate(parent::PAGE_NUM);
        }

        $categorys = CategoryLogic::getCategorys();
        $outdatas = [];
        foreach ($pageList as $outdata) {
            $outdata->category_name = isset($categorys[$outdata->category_id]) ? $categorys[$outdata->category_id]->name : '';
            $outdatas[] = $outdata;
        }
        $pageList->appends(['q' => $query, 'cateId' => $cateId])->links();
        $data = array('page_title' => '出库记录',
            'page_description' => '增加，搜索出库记录',
            'pageList' => $pageList,
            'outdatas' => $outdatas,
            'query' => $query,
            'cateId' => $cateId,
            'categorys' => CategoryLogic::formatCanNoneCategorySelect());
        return view('materialout.list', $data);
    }

    public function create(Request $request, $id)
    {
        $storage = Storage::find($id);
        if (!$storage) {
            app('messageAlert')->store('出库失败', MessageAlert::DANGER, '未找到对应的物品。');
            return redirect()->route('materialout.storage');
        }
        $storage->storage_num = $this->transferDanwei($storage->storage_num, $storage->danwei);

        $categorys = CategoryLogic::formatCategorySelect();
        $user = $request->user();
        $data = [
            'page_title' => '添加出库',
            'page_description' => '增加出库记录',
            'categorys' => $categorys,
            'user' => $user,
            'storage' => $storage,
            'danweis' => $this->selectDanweis
        ];
        return view('materialout.create', $data);
    }

    public function store(Request $request) {

        $this->validate($request,
            [
                'xinghao' => 'required',
                'material_name' => 'required',
                'out_num' => 'required|integer|min:1',
                'check_user' => 'required|string',
            ],
            [],
            [
                'xinghao' => '型号',
                'material_name' => '材料名称',
                'out_num' => '数量',
                'check_user' => '验收人',
            ]
        );

        $data = $request->all();
        $data['out_time'] = date('Y-m-d H:i:s');

        $outNum = $request->input('out_num');
        $danwei = $request->input('danwei');
        $danweiRate = $this->danweiRates[$danwei];
        $storageReduce = $outNum * $danweiRate;

        $storage = Storage::where('xinghao', $request->input('xinghao'))->first();

        if (!$storage || $storage->storage_num < $storageReduce) {
            app('messageAlert')->store('出库失败', MessageAlert::DANGER, '库存数量不足。');
            return redirect()->route('materialout.storage');
        }
        MaterialOut::create($data);

        $storage->storage_num -= $storageReduce;
        if ($storage->storage_num <= 0) {
            $storage->delete();
        } else {
            $storage->update();
        }

        app('messageAlert')->store('保存成功', MessageAlert::SUCCESS, '出库记录增加成功。');
        return redirect()->route('materialout.index');
    }

    public function storage(Request $request)
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
        $data = array('page_title' => '物资出库',
            'page_description' => '',
            'pageList' => $pageList,
            'storages' => $storages,
            'query' => $query,
            'cateId' => $cateId,
            'categorys' => CategoryLogic::formatCanNoneCategorySelect()
        );
        return view('materialout.storage', $data);
    }
}
