<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserRegisterEvent;
use App\Http\Requests\Admin\SettingsIntegralCreate;
use App\Http\Requests\Admin\SettingsIntegralUpdate;
use App\Models\SettingsIntegralModel;
use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsIntegralController extends CommonController
{
    protected $fields = [
        'title' =>'',
        'number' =>0,
        'mark' =>'',
        'remark' =>'',
        'type' =>10,
        'status' =>20,
        'template' =>''
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = '';
        if($request->has('word')){
            $word = $request->word;
            $infos = SettingsIntegralModel::orderBy('id','desc')->where('title','like','%'.$word.'%')->paginate(15);
        }else{
            $infos = SettingsIntegralModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin.'.integral.index',compact('infos','word'));
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
        return view($this->skin.'.integral.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //https://github.com/big-pang/laravel5.3-admin/blob/master/app/Http/Controllers/Admin/PermissionController.php
    public function store(SettingsIntegralCreate $request)
    {
        SettingsIntegralModel::create($request->all());
        return redirect()
            ->route('integral.index')
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
        $infos = SettingsIntegralModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.integral.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsIntegralUpdate $request, $id)
    {
        $infos = SettingsIntegralModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('integral.index')
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
        $infos = SettingsIntegralModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
