<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\CompanyCreateRequest;
use App\Http\Requests\Admin\CompanyUpdateRequest;

use App\Models\CompanyModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends CommonController
{
    protected $fields = [
        'com_name' => '',
        'com_address' => '',
        'com_telphone' => '',
        'contact' => '',
        'contact_telphone' => '',
        'com_status' => 10,
        'own' => 10,
        'shorthand' => '',
        'remarks' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = '';
        if ($request->has('word')) {
            $word = $request->word;
            $infos = CompanyModel::orderBy('id','desc')->where('com_name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = CompanyModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin . '.company.index', compact('infos', 'word'));
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
        return view($this->skin . '.company.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyCreateRequest $request)
    {
        $infos = $request->all();
        $result = CompanyModel::create($infos);

       // $result['mark'] = 'manage';//启用分组事件，必须设置mark标识符，值可以为空
       // event(new  CompanyRegisterEvent($result));//注册时事件及事件监听器
        return redirect()
            ->route('company.index')
            ->with([
                'flash_message' => '数据添加成功'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = CompanyModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin . '.company.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyUpdateRequest $request, $id)
    {
        $infos = CompanyModel::findOrFail((int)$id);

        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('company.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除权限验证
        $status = del_destroy('destroy',session('user_role'));
        if($status['code'] == 4000){
            return response()->json($status);
        }

        $infos = CompanyModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }

}
