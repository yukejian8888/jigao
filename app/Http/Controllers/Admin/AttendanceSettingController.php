<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AttendanceSettingCreate;
use App\Http\Requests\Admin\AttendanceSettingUpdate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttendanceSettingModel;
use App\Models\UserModel;

class AttendanceSettingController extends CommonController
{
    protected $fields = [
        'rule_name' => '',
        'status' => 10,
        'address' => '',
        'need_attendance_people' => '',
        'check_in_time' => '',
        'check_out_time' => '',
        'earliest_time' => '',
        'allow_late_time' => '',
        'allow_leave_time' => ''

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
            $infos = AttendanceSettingModel::orderBy('id','desc')->where('rule_name', 'like', '%' . $word . '%')
                ->paginate(15);
        } else {
            $infos = AttendanceSettingModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin . '.attendance_setting.index', compact('infos', 'word'));
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
        $user = UserModel::orderBy('id','desc')->where("com_id",'1')->get();
        $user = object_to_array($user);
        foreach ($user as $k=>$v){
            $user2[$v['id']] = $v['name'];
        }
        $data['user'] = $user2;
        return view($this->skin . '.attendance_setting.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendanceSettingCreate $request)
    {
        $input = $request->all();
        if($request->has('need_attendance_people')){
            $need_attendance_people=implode(",",$input['need_attendance_people']);
            $input['need_attendance_people'] = ','.$need_attendance_people.',';
        }
       if($request->has('address')){
           $input['address'] = json_encode($input['address']);
        }
        AttendanceSettingModel::create($input);

        return redirect()
            ->route('attendance_setting.index')
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
        $infos = AttendanceSettingModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        if($data['need_attendance_people']!="") {
            $user = substr(rtrim($data['need_attendance_people'], ","),1);
            $data['need_attendance_people'] = explode(',',$user);
        }else{
            $data['need_attendance_people'] = '';
        }
        if($infos['address']) {
            $data['address'] = \GuzzleHttp\json_decode($infos['address'], true);
        }
        return view($this->skin . '.attendance_setting.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttendanceSettingUpdate $request, $id)
    {
        $input = $request->all();
        $infos = AttendanceSettingModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if($request->has('need_attendance_people')){
            $need_attendance_people=implode(",",$input['need_attendance_people']);
            $infos->need_attendance_people = ','.$need_attendance_people.',';
        }
        if($request->has('address')){
            $address = json_encode($input['address']);
            $infos->address = $address;
        }
        $infos->save();
        return redirect()
            ->route('attendance_setting.index')
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
        $infos = AttendanceSettingModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response json
     */
    public function get_user_list(Request $request)
    {
        $user_id = $request->get('user_id');
        $infos_user = get_user_list_by_user_id_not_in_array(explode(',',$user_id));
        $response = array(
            'status'=>'s',
            'code'=>'1000',
            'list'=>$infos_user
        );
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response json
     */
    public function get_user(Request $request)
    {
        $user_id = $request->get('user_id');
        $infos_user = get_user_info($user_id);
        $response = array(
            'status'=>'s',
            'code'=>'1000',
            'data'=>$infos_user
        );
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
}
