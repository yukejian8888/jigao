<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WeeklyCreate;
use App\Http\Requests\Admin\WeeklyUpdate;
use App\Models\WeeklyModel;
use App\Models\WeeklyItemModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeeklyController extends CommonController
{
    protected $fields = [
        'user_id' => '',
        'title' => '',
        'project_name' => '',
        'start_time' => '',
        'end_time' => '',
        'remark' => '',
        'actual_complete_time' => '',
        'complete_status' => 10,
        'plan_remark' => '',
        'complete_remark' => '',
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
            $infos = WeeklyModel::orderBy('id','desc')->where('user_id',session('user_id'))->where('title', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = WeeklyModel::orderBy('id','desc')->where('user_id',session('user_id'))->paginate(15);
        }
        return view($this->skin . '.weekly.index', compact('infos', 'word'));
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
        $data['item'] = array();
        return view($this->skin . '.weekly.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(WeeklyCreate $request)
    {
        $input = $request->all();
        //dump($input);exit;
        $user_id = session('user_id');
        $input_weekly['user_id'] = $user_id;
        $input_weekly['title'] = $input['title'];
        $input_weekly['plan_remark'] = $input['plan_remark'];
        $weekly = WeeklyModel::create($input_weekly);
        $weekly = object_to_array($weekly);

        foreach($input['project_name'] as $key=>$v){
            $data['project_name'] = $v;
            $data['start_time'] = strtotime($input['start_time'][$key]);
            $data['end_time'] = strtotime($input['end_time'][$key]);
            $data['remark'] = $input['remark'][$key];
            $data['user_id'] = $user_id;
            $data['weekly_id'] = $weekly['id'];
            WeeklyItemModel::create($data);
        }

        return redirect()
            ->route('weekly.index')
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
    //周报查看
    public function show($id)
    {
        $data = WeeklyModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $data->$field);
        }
        $data['id'] = (int)$id;
        $data['item'] = WeeklyItemModel::where('weekly_id',$id)->get();
        $data['item'] = object_to_array($data['item']);

        return view($this->skin . '.weekly.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = WeeklyModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $data->$field);
        }
        $data['id'] = (int)$id;
        $data['item'] = WeeklyItemModel::where('weekly_id',$id)->get();
        $data['item'] = object_to_array($data['item']);

        return view($this->skin . '.weekly.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $project_id = $request->get('project_id');

        //更新周报表
        $data['title'] = $input['title'];
        $data['plan_remark'] = $input['plan_remark'];
        WeeklyModel::where('id',$id)->update($data);
        $model = new WeeklyItemModel();

        //更新周报项目表
        foreach($input['project_id'] as $key=>$v){
            if($input['project_id'][$key] != ''){
                $datas['project_name'] = $input['project_name'][$key];
                $datas['start_time'] = strtotime($input['start_time'][$key]);
                $datas['end_time'] = strtotime($input['end_time'][$key]);
                $datas['remark'] = $input['remark'][$key];
                WeeklyItemModel::where('id',$v)->update($datas);
            }else{
                $data['project_name'] = $input['project_name'][$key];
                $data['start_time'] = strtotime($input['start_time'][$key]);
                $data['end_time'] = strtotime($input['end_time'][$key]);
                $data['remark'] = $input['remark'][$key];
                $data['user_id'] = session('user_id');
                $data['weekly_id'] = $id;
                $res[] = WeeklyItemModel::create($data);
                $res = object_to_array($res);
                foreach($res as $k => $v){
                    $project_id[] =  $v['id'];
                }
            }
        }

        $model::where('weekly_id',$id)->whereNotIn('id',$project_id)->delete();

        return redirect()
            ->route('weekly.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }

    //上报
    public function reported(Request $request)
    {
        //初始化审批数据
        $reported_data_id = $request->get('reported_data_id');
        $infos = WeeklyModel::where('id',$reported_data_id)->first();
        $infos['submit_status'] = 11;//上报状态
        $rs = $infos->save();
        if($rs){
            $response = array(
                'status'=>'s',
                'code'=>'1000',
                'msg'=>'周报已上报',
            );
        }else{
            $response = array(
                'status'=>'f',
                'code'=>'4000',
                'msg'=>'上报失败，请重新操作'
            );
        }
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }

    //汇报编辑
    public function reportedit($id)
    {
        $data = WeeklyModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $data->$field);
        }
        $data['id'] = (int)$id;
        $data['item'] = WeeklyItemModel::where('weekly_id',$id)->get();
        $data['item'] = object_to_array($data['item']);
        return view($this->skin . '.weekly.reportedit', $data);
    }

    //汇报编辑 提交
    public function update_report(Request $request, $id)
    {
        $input = $request->all();

        //更新周报表的complete_remark
        $data['complete_remark'] = $input['complete_remark'];
        WeeklyModel::where('id',$id)->update($data);

        //循环更新周报项目表的完成情况
        foreach($input['project_id'] as $key=>$v){
            $datas['actual_complete_time'] = strtotime($input['actual_complete_time'][$key]);
            $datas['complete_status'] = $input['complete_status'][$key];
            WeeklyItemModel::where('id',$v)->update($datas);
        }

        return redirect()
            ->route('weekly.index')
            ->with([
                'flash_message' => '上报编辑成功'
            ]);
    }

    //汇报
    public function report(Request $request)
    {
        //初始化审批数据
        $report_data_id = $request->get('report_data_id');
        $infos = WeeklyModel::where('id',$report_data_id)->first();
        $infos['submit_status'] = 20;//汇报状态
        $rs = $infos->save();
        if($rs){
            $response = array(
                'status'=>'s',
                'code'=>'1000',
                'msg'=>'周报已汇报',
            );
        }else{
            $response = array(
                'status'=>'f',
                'code'=>'4000',
                'msg'=>'汇报失败，请重新操作'
            );
        }
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
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
        $status = del_destroy('destroy', session('user_role'));
        if ($status == 4000) {
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '没有删除权限');
            return response()->json($array);
        }

        $infos = WeeklyModel::destroy((int)$id);

        WeeklyItemModel::where('weekly_id', $id)->delete();

        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
