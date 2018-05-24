<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\OrganizationCreate;
use App\Http\Requests\Admin\OrganizationUpdate;

use App\Models\OrganizationModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrganizationController extends CommonController
{
    protected $fields = [
        'name' => '',
        'status' => '10',
        'pid' => '',
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
            $infos = OrganizationModel::orderBy('id','asc')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = OrganizationModel::orderBy('id','asc')->paginate();
        }
        $infos = infiniteclass($infos,0,0);

        return view($this->skin . '.organization.index', compact('infos', 'word'));
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

        $model =  new \App\Models\OrganizationModel();
        $data['organization'] = get_select_menu_k_v("首级单位",$model,"name");
        return view($this->skin . '.organization.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganizationCreate $request)
    {
        $infos = $request->all();

        $result = OrganizationModel::create($infos);

        return redirect()
            ->route('organization.index')
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
        //组织架构展示
        $data =  OrganizationModel::get();
        //var_dump($data);
        $infos = infiniteclass($data,0,0);

        return view($this->skin . '.organization.show',compact('infos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = OrganizationModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;

        $model = new \App\Models\OrganizationModel();
        $data['organization'] = get_select_menu_k_v("首级单位",$model,"name");
        return view($this->skin . '.organization.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationUpdate $request, $id)
    {
        //根据当前数据的pid，如果是0，就把引用它的pid都改为0
        //不需要固定起点的无限级
       /* $this_pid = OrganizationModel::where('id',$id)->first();
        $pid = $request->get('pid');
        if($this_pid['attributes']['pid'] == 0){
            do{
                $arr = OrganizationModel::where('id',$pid)->first();
                $pid = $arr['attributes']['pid'];
                if($arr['attributes']['pid'] == 0 && $arr['attributes']['id'] == $id){
                    DB::statement("update hh_Organization  set pid=REPLACE(pid,$id,'0')");
                    break;
                }
            }while(!empty($arr));
        }*/
        //判断不能在自身降级
        $pid = $request->get('pid');
        do{
            $arr = OrganizationModel::where('id', $pid)->first();
            $pid = $arr['attributes']['pid'];
            if($arr['attributes']['pid'] == $id){
                return redirect()
                    ->route('organization.index')
                    ->with([
                        'flash_message' => '上级架构不能更改为自身子级架构！'
                    ]);
                break;
            }
        }while(!empty($arr));

        $infos = OrganizationModel::findOrFail((int)$id);

        if($infos['attributes']['pid'] == 0) {
            return redirect()
                ->route('organization.index')
                ->with([
                    'flash_message' => '该分类下存在子级分类，请先删除子分类！'
                ]);
        }else if($request->pid == (int)$id){
            return redirect()
                ->route('organization.index')
                ->with([
                    'flash_message' => '不能指定自身为隶属关系！'
                ]);

        }else{
            foreach (array_keys($this->fields) as $field) {
                $infos->$field = $request->get($field);
            }
            $infos->save();


            return redirect()
                ->route('organization.index')
                ->with([
                    'flash_message' => '编辑成功'
                ]);
        }

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
        //验证当前分类下是否包含子分类
        $sub_infos = OrganizationModel::where('pid',$id)->get(['id']);
        //dump(!$sub_infos->isEmpty());
        if(!$sub_infos->isEmpty()){
            $array = array('status'=>'f','code'=>4000,'msg'=>'该分类下存在子分类，请先删除子分类！');
            //dump($array);
        }else{
            $infos = OrganizationModel::destroy((int)$id);
            if($infos){//1成功
                $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
            }else{//0失败
                $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
            }
        }
        return response()->json($array);
    }
}
