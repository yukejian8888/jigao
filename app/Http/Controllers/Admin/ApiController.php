<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ApiCreateRequest;
use App\Http\Requests\Admin\ApiUpdateRequest;
use App\Models\ApiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiController extends CommonController
{
    protected $fields = [
        'title' =>'',
        'remark' =>'',
        'key' =>'',
        'secret' =>'',
        'status' =>20
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
            $infos = ApiModel::orderBy('id','desc')->where('title','like','%'.$word.'%')->paginate(15);
        }else{
            $infos = ApiModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin.'.api.index',compact('infos','word'));
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
        return view($this->skin.'.api.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //https://github.com/big-pang/laravel5.3-admin/blob/master/app/Http/Controllers/Admin/PermissionController.php
    public function store(ApiCreateRequest $request)
    {
        $infos = $request->all();
        $infos['key'] = Hash::make($infos['key']?$infos['key']:'123456');
        $infos['secret'] = Hash::make($infos['secret']?$infos['secret']:'123456');
        ApiModel::create($infos);
        return redirect()
            ->route('api.index')
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
        $infos = ApiModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.api.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiUpdateRequest $request, $id)
    {
        $infos = ApiModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);

            if(empty($request->get('key'))):
                $infos->key = Hash::make('123456');
            endif;
            if(empty($request->get('secret'))):
                $infos->secret = Hash::make('123456');
            endif;
        }
        $infos->save();
        return redirect()
            ->route('api.index')
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
        $infos = ApiModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
