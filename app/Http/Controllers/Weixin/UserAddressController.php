<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_address.address_list',compact('infos'));
    }
    public function edit()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_address.edit',compact('infos'));
    }
    public function add()
    {
        $infos = '';
        return view( $this->_skin .'.user.user_address.add',compact('infos'));
    }

    /**
     * get_address_info
     * 获取地址信息
     */
    public function get_address_info(Request $request)
    {
        $user_id = session('user_id');
        $response = get_address_info_by_default($user_id);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * get_address_info
     * 获取地址信息
     */
    public function get_address_list(Request $request)
    {
        $user_id = session('user_id');
        $response = get_address_list($user_id);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
}
