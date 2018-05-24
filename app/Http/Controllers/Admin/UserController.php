<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use App\Models\CompanyModel;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends CommonController
{
    protected $fields = [
        'name' => '',
        'status' => 20,
        'email' => '',
        'phone' => '',
        'password' => '',
        'birthday' => '',
        'com_id' => '',
        'office_id' => '',
        'remarks' => '',
        'department' => '',
        'homeaddress' => '',
        'authority' => '',
        'role_id' => '',
        'sex' => 10,

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
            $infos = UserModel::orderBy('id','desc')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = UserModel::orderBy('id','asc')->paginate(15);
        }
        return view($this->skin . '.user.index', compact('infos', 'word'));
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
        //权限查询，调用权限模型'此处在完成中，完成后修改
        $model = new \App\Models\OrganizationModel();
        $data['authority'] = get_select_menu_k_v("请选择权限",$model,"name");
        //角色查询
        $model = new \App\Models\RoleModel();
        //$data['role'] = get_select_menu_k_v("请选择角色",$model,"role_name");
        $data['role'] = $model::get();
        //公司查询，调用权限模型
        $model = new \App\Models\CompanyModel();
        $data['company'] = get_select_menu_k_v("请选择公司",$model,"com_name");
        return view($this->skin . '.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $infos = $request->all();
        if (isset($infos['role_id'])) {
            $role_id = $infos['role_id'];
            unset($infos->role_id);
        }
        $infos['password'] = Hash::make($infos['password']);
        $result = UserModel::create($infos);
        //删除原有角色记录
        $model = new \App\Models\UserRoleModel();
        if (isset($role_id))
        {
            $result = add_table_data($model, $role_id, 'user_id', $result['attributes']['id'], session('user_id'), 'add_user_id', 'role_id', 1);
        }
        return redirect()
            ->route('user.index')
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
        $infos = UserModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;

        //单位查询
        //权限查询，调用权限模型'此处在完成中，完成后修改
        $model = new \App\Models\OrganizationModel();
        $data['authority'] = get_select_menu_k_v("请选择权限",$model,"name");
        //角色查询
        $model = new \App\Models\RoleModel();
        //$data['role'] = get_select_menu_k_v("请选择角色",$model,"role_name");
        $data['role'] = $model::get();
        //当前id具有角色查询
        $model = new \App\Models\UserRoleModel();
        $user_id = $model::where('user_id',$id)->pluck('role_id');
        $datarray = [];
        for($i=0;$i<count($data['role']);$i++){
            $datarray[$i] = $data['role'][$i]['original'];
        }
        $datarrayarray = [];
        foreach($user_id as $k => $v){
            $datarrayarray[$k] = $v;
        }
        for($i=0;$i<count($datarray);$i++){
            if(in_array($datarray[$i]['id'],$datarrayarray)) {
                $datarray[$i]['checked'] = 'checked';
            }else{
                $datarray[$i]['checked'] = '';
            }
        }
        $data['role'] = $datarray;
        //公司查询，调用权限模型
        $model = new \App\Models\CompanyModel();
        $data['company'] = get_select_menu_k_v("请选择公司",$model,"com_name");

        return view($this->skin . '.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $rules = [
            'name'=>'unique:users,name,'.$id,
            'email'=>'unique:users,email,'.$id,
            'phone'=>'unique:users,phone,'.$id
        ];
        $messages = [
            'name.unique' => '用户名已经存在',
            'email.unique' => '邮箱已经存在',
            'phone.unique' => '手机号码已经存在'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if($validator->fails()){
            return redirect(route('user.edit',$id))
                ->withErrors($validator)
                ->withInput();
        }

        $infos = UserModel::findOrFail((int)$id);

        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
            if(!empty($request->get('password'))):
                $infos->password = Hash::make($request->get('password'));
            else:
                unset($infos->password);
            endif;
        }
        $role_id = $infos->role_id;
        unset($infos->role_id);
        $infos->save();

        //删除原有角色记录
        $model =  new \App\Models\UserRoleModel();
        $result = add_table_data($model,$role_id,'user_id',$id,session('user_id'),'add_user_id','role_id',1);
        return redirect()
            ->route('user.index')
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

        $model = new \App\Models\UserRoleModel();
        $res = $model::where('user_id',$id)->delete();
        $infos = UserModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }

    public function user(){
        
        return view('admin.user.user');
    }
            
}
