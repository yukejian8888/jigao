<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SettingsUpdateRequest;
use App\Models\SettingsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends CommonController
{
    protected $fields = [
        'config_value' =>''
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gid = $request->gid?$request->gid:10;//不存在时默认站点配置信息
        $infos = SettingsModel::where('group_id',$gid)->orderBy('id','asc')->get();
        return view($this->skin.'.settings.index',compact('infos','gid'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //https://github.com/big-pang/laravel5.3-admin/blob/master/app/Http/Controllers/Admin/PermissionController.php
    public function update(SettingsUpdateRequest $request)
    {
        $inputs = $request->all();
        foreach ($inputs['value'] as $k=>$v){
            $infos = SettingsModel::findOrFail((int)$k);
            $infos->config_value = $v;
            $infos->save();
        }
        $gid = $request->gid?$request->gid:10;//不存在时默认站点配置信息
        return redirect()
            ->route('settings.index',['gid'=>$gid])
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }
}
