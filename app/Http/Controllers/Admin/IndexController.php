<?php

namespace App\Http\Controllers\Admin;

use ClassPreloader\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        echo time();
//        echo '<pre>';
//        $tt = config('menu_admin.menu_list');
//        print_r($tt);
//        exit;
//        $user = DB::get();
//        echo '<pre>';
//        print_r($user);
//        exit;
        return view('admin.index.index');
    }

    public function datatables()
    {
        return view('admin.tpl.datatables');
    }
    public function datatablessimple()
    {
        return view('admin.tpl.datatablessimple');
    }
    public function form()
    {
        return view('admin.tpl.forms');
    }
}
