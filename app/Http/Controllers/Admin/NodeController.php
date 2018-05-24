<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\NodeCreate;
use App\Http\Requests\Admin\NodeUpdate;
use App\Models\NodeModel;

class NodeController extends CommonController
{
    //
    protected $fields = [
        'name' => '',
        'status' => 10,
        'pid' => 0,
        'node_route' => '',
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
            $infos = NodeModel::orderBy('id','asc')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = NodeModel::orderBy('id','asc')->get();
        }
        $infos = infiniteclass($infos,0,0);
        return view($this->skin . '.node.index', compact('infos', 'word'));
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
        $model =  new \App\Models\nodeModel();
        $data['node'] = get_select_menu_k_v("首级节点",$model,"name",1);
        return view($this->skin . '.node.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NodeCreate $request)
    {
        $infos = $request->all();
        $result = NodeModel::create($infos);

        return redirect()
            ->route('node.index')
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
        //权限
        $infos =  NodeModel::where('id',$id)->first();
        $infos['node'] = NodeModel::where('pid',$id)->get();
        return view($this->skin . '.node.show',compact('infos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = NodeModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        $model =  new \App\Models\nodeModel();
        $data['node'] = get_select_menu_k_v("首级节点",$model,"name");
        return view($this->skin . '.node.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NodeUpdate $request, $id)
    {
        $infos = NodeModel::findOrFail((int)$id);

        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if($infos['pid'] == null){
            unset($infos['pid']);
        }
        $infos->save();
        return redirect()
            ->route('node.index')
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
        //验证当前分类下是否包含子分类
        $sub_infos = NodeModel::where('pid',$id)->get(['id']);
        //dump(!$sub_infos->isEmpty());
        if(!$sub_infos->isEmpty()){
            $array = array('status'=>'f','code'=>4000,'msg'=>'该节点下存在子节点,请先删除子节点！');
            //dump($array);
        }else {
            $infos = NodeModel::destroy((int)$id);
            if ($infos) {//1成功
                $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
            } else {//0失败
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
            }
        }
        return response()->json($array);
    }
}
