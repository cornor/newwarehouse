<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use MessageAlert;
use App\Models\Category;
use UserLog;

class CategoryController extends Controller
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
        $categorys = Category::all();
        $data = array('page_title' => '类别列表', 'page_description' => '',
            'categorys' => $categorys);
        return view('category.list', $data);
    }

    public function show(Request $request)
    {

        return $this->index($request);
    }

    public function create(Request $request)
    {
        $parents = $this->formatParentCategorySelect();
        $data = array('page_title' => '新建类别', 'page_description' => '增加一个类别', 'parents' => $parents);
        return view('category.create', $data);
    }

    function formatParentCategorySelect() {
        $categorys = Category::all();
        $pArr = [0 => '请选择父类别'];
        foreach ($categorys as $category) {
            if($category->pid == 0) {
                $pArr[$category->id] = $category->name;
            }
        }
        return $pArr;
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|string|min:2'], [],['name' => '类别名']);
        $pid = (int) $request->input('pid');
        $pname = '';
        if ($pid > 0) {
            $category = Category::find($pid);
            if ($category) {
                $pname = $category->name;
            } else {
                $pid = 0;
            }
        }
        Category::add($pid, $pname, $request['name']);
        app('messageAlert')->store('保存成功', MessageAlert::SUCCESS, '新类别保存成功。');
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $id = intval($id);
        if ($id > 0) {
            Category::destroy($id);
            Category::where('pid', $id)->delete();
        }
        app('messageAlert')->store('更新成功', MessageAlert::SUCCESS, '类别信息更新成功。');
        return redirect()->route('category.index');
    }

}
