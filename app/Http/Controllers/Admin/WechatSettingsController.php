<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WechatSettingsCreateRequest;
use App\Http\Requests\Admin\WechatSettingsUpdateRequest;
use App\ModelsWechat\WechatSettingsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatSettingsController extends CommonController
{
    protected $fields = [
        'name' =>'',
        'number' =>'',
        'app_id' =>'',
        'secret' =>'',
        'token' =>'',
        'aes_key' =>'',
        'pic' =>'',
        'status' =>20
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $infos = WechatSettingsModel::orderBy('id','desc')->paginate(15);

        return view($this->skin.'.wechat_settings.index',compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        return view($this->skin.'.wechat_settings.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //https://github.com/big-pang/laravel5.3-admin/blob/master/app/Http/Controllers/Admin/PermissionController.php
    public function store(WechatSettingsCreateRequest $request)
    {
        $infos = $request->all();
        WechatSettingsModel::create($infos);
        return redirect()
            ->route('wechat_settings.index')
            ->with([
                'flash_message' => '数据添加成功'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = WechatSettingsModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.wechat_settings.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WechatSettingsUpdateRequest $request, $id)
    {
        $infos = WechatSettingsModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('wechat_settings.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infos = WechatSettingsModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
