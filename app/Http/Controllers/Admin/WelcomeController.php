<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WelcomeController extends Controller
{
    public function index()
	{
        return redirect()->route('storage.index');
        //return 'welcome';
	}


    public function butNoPermission()
    {
        return view('admin.no_permission')->with('page_title','系统信息');
	}
}
