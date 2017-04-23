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
            $count = MaterialIn::where($conditions)->count();
            $this->setDefaultPage($request, $count);
            $pageList = MaterialIn::where($conditions)->paginate(parent::PAGE_NUM);
        } else {
            $count = MaterialIn::count();
            $this->setDefaultPage($request, $count);
            $pageList = MaterialIn::paginate(parent::PAGE_NUM);
        }
        $categorys = CategoryLogic::getCategorys();

        $indatas = [];
        foreach ($pageList as $indata) {
            $indata->category_name = isset($categorys[$indata->category_id]) ? $categorys[$indata->category_id]->name : '';
            $indatas[] = $indata;
        }
        $pageList->appends(['q' => $query, 'cateId' => $cateId])->links();
        $data = array('page_title' => '入库记录',
            'page_description' => '增加，搜索入库记录',
            'indatas' => $indatas,
            'pageList' => $pageList,
            'query' => $query,
            'cateId' => $cateId,
            'categorys' => CategoryLogic::formatCanNoneCategorySelect()
        );
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
            'user' => $user,
            'danweis' => $this->selectDanweis
        ];
        return view('materialin.create', $data);
    }

    public function store(Request $request) {

        $this->validate($request,
            [
                'xinghao' => 'required',
                'material_name' => 'required',
                'in_num' => 'required|integer|min:1',
                'check_user' => 'required|string',
                'danwei' => 'required|string',
            ],
            [],
            [
                'xinghao' => '型号',
                'material_name' => '材料名称',
                'in_num' => '数量',
                'check_user' => '验收人',
                'danwei' => '单位',
            ]
        );

        $inNum = $request->input('in_num');
        $danwei = $request->input('danwei');
        $danweiRate = $this->danweiRates[$danwei];
        $storageAdd = $inNum * $danweiRate;

        $data = $request->all();
        $data['in_time'] = date('Y-m-d H:i:s');
        $data['price'] = (int) $request->input('price', 0);
        MaterialIn::create($data);

        $xiandingNum = $request->input('xianding_num');
        $xiandingData = intval($xiandingNum) * $danweiRate;

        $storage = Storage::where('xinghao', $request->input('xinghao'))->first();
        if ($storage) {
            $storage->storage_num += $storageAdd;
            $storage->store_place = $request->input('store_place');
            $storage->remark = $request->input('remark');
            $storage->danwei = $danwei;
            if ($xiandingNum !== '') {
                $storage->xianding_num = (int) $xiandingData;
            }
            $storage->update();
        } else {
            $data['storage_num'] = $storageAdd;
            $data['xianding_num'] = (int) $xiandingData;
            Storage::create($data);
        }

        app('messageAlert')->store('保存成功', MessageAlert::SUCCESS, '入库记录增加成功。');
        return redirect()->route('materialin.index');
    }

    public function xhsearch(Request $request)
    {
        $xinghao = $request->input('xinghao', '');
        $data['es'] = 0;
        if ($xinghao) {
            $storage = Storage::where('xinghao', $request->input('xinghao'))->first();
            if ($storage) {
                $data['es'] = 1;
                $data['xianding_num'] = $this->transferDanwei($storage->xianding_num, $storage->danwei);
                $data['danwei'] = $storage->danwei;
            }
        }
        return json_encode($data);
    }
}
