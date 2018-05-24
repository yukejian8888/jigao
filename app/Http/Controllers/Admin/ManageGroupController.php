<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ManageGroupCreate;
use App\Http\Requests\Admin\ManageGroupUpdate;
use App\Models\ManageGroupModel;
use Illuminate\Http\Request;

class ManageGroupController extends CommonController
{
    protected $fields = [
        'name' => '',
        'mark' => '',
        'remark' => '',
        'status_system' => 11,
        'status_default' => 11//默认状态11否，10是
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
            $infos = ManageGroupModel::orderBy('id')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = ManageGroupModel::orderBy('id')->paginate(15);
        }
        return view($this->skin . '.manage_group.index', compact('infos', 'word'));
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
//        $data['select'] = list_to_tree('manage_group');
        return view($this->skin . '.manage_group.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManageGroupCreate $request)
    {
        ManageGroupModel::create($request->all());
        return redirect()
            ->route('manage_group.index')
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
        $infos = ManageGroupModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
//        $data['select'] = list_to_tree('manage_group');
        $data['id'] = (int)$id;
        return view($this->skin . '.manage_group.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManageGroupUpdate $request, $id)
    {
        $infos = ManageGroupModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if($infos->status_system==10){
            unset($infos->mark);
        }
        if($infos->status_default==10){//设置当前分组为默认分组时需要批量更新其他默认分组值
            ManageGroupModel::where('id','<>',$id)->update(['status_default'=>11]);
        }
        $infos->save();
        return redirect()
            ->route('manage_group.index')
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
        $infos = ManageGroupModel::find((int)$id);
        if($infos['status_system'] ==10){
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '系统级用户组禁止删除！');
            return response()->json($array);
            exit;
        }
        $infos = ManageGroupModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
