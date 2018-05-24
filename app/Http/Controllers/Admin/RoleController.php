<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\RoleCreateRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;

use App\Models\RoleModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends CommonController
{
    protected $fields = [
        'role_name' => '',
        'role_status' => 10,
        'role_level' => '',
        'remarks' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $url = del_destroy('destroy',session('user_role') );
//        dump($url);
        $word = '';
        if ($request->has('word')) {
            $word = $request->word;

            $infos = RoleModel::orderBy('id','asc')->where('role_name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = RoleModel::orderBy('id','asc')->paginate(15);
        }
        return view($this->skin . '.role.index', compact('infos', 'word'));
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
        return view($this->skin . '.role.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {

        $infos = $request->all();

        $result = RoleModel::create($infos);

        return redirect()
            ->route('role.index')
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
        //查询权限表当前所有权限
        $authoritymodel =  new \App\Models\AuthorityModel();
        $authority = $authoritymodel::get();
        //查询当前角色名，用于左上角显示
        $name = RoleModel::where('id',$id)->value('role_name');
        //查询当前角色所具备权限，用于选中
        $roleauthoritymodel =  new \App\Models\RoleAuthorityModel();
        $roleauthority = $roleauthoritymodel::where('role_id',$id)->pluck('authority_id');
        $data = [];
        for($i=0;$i<count($authority);$i++){
            $data[$i] = $authority[$i]['original'];
        }
        $dataarray = [];
        foreach($roleauthority as $k => $v){
            $dataarray[$k] = $v;
        }
        for($i=0;$i<count($data);$i++){
            if(in_array($data[$i]['id'],$dataarray)) {
                $data[$i]['checked'] = 'checked';
            }else{
                $data[$i]['checked'] = '';
            }
        }
        $authority = $data;
        return view($this->skin . '.role.show',compact('authority','id','name','roleauthority'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function role_authority(Request $request)
    {
        $model =  new \App\Models\RoleAuthorityModel();
        $id = $request->id;
        $res = $model::where('role_id',$id)->delete();//删除原有角色权限记录
        $input['role_id'] = $id;
        $input['add_user_id'] = session('user_id');
        if(count($request->role_authority) >0 ) {
            foreach ($request->role_authority as $item) {
                $input['authority_id'] = $item;
                $result = $model::create($input);
            }
        }
        return redirect()
            ->route('role.index')
            ->with([
                'flash_message' => '数据添加成功'
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = RoleModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin . '.role.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
//        return redirect()
//            ->route('role.index')
//            ->with([
//                'flash_message' => '禁止修改会员信息'
//            ]);
        $rules = [
            'name'=>'unique:roles,name,'.$id,
            'email'=>'unique:roles,email,'.$id,
            'phone'=>'unique:roles,phone,'.$id
        ];
        $messages = [
            'name.unique' => '用户名已经存在',
            'email.unique' => '邮箱已经存在',
            'phone.unique' => '手机号码已经存在'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(route('role.edit',$id))
                ->withErrors($validator)
                ->withInput();
        }
        $infos = RoleModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
            if(!empty($request->get('password'))):
                $infos->password = Hash::make($request->get('password'));
            else:
                unset($infos->password);
            endif;
        }
        $infos->save();
        return redirect()
            ->route('role.index')
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


        $model = new \App\Models\RoleAuthorityModel();
        $res = $model::where('role_id',$id)->delete();
        $infos = RoleModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }

            
}
