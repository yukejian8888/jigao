<?php

namespace App\Http\Controllers\Workflow;

use App\Models\FormDesignModel;
use App\Models\FormWorkflowRuleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormWorkflowController extends CommonController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos_design = FormDesignModel::find((int)$id);
        $infos_rule = FormWorkflowRuleModel::where('form_id',$id)->get();
        $infos_rule = object_to_array($infos_rule);
        return view($this->skin.'.form_workflow.edit',compact('infos_design','infos_rule'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = $request->get('user_id');
        $grade = $request->get('grade');
        $type_approval = $request->get('type_approval');
        $input['form_id'] = $id;//表单id
        $model = new FormWorkflowRuleModel();
        DB::beginTransaction();
        try{
            //存在数据时，先执行删除操作
            $infos_all = $model::where('form_id',$id)->first();
            if($infos_all){
                $infos_del = $model::where('form_id',$id)->delete();
                if(!$infos_del){
                    throw new \Exception('工作流参数删除数据失败');
                }
            }
            //循环处理数据
            $i = 1;
            foreach ($type_approval as $k=>$v){
                $input['grade'] = $i;//等级
                if($user_id){
                    if(array_key_exists($k,$user_id)){
                        $input['user_id'] = \GuzzleHttp\json_encode($user_id[$k]);
                        $input['status_check'] = 20;
                    }else{
                        $input['status_check'] = 10;
                    }
                }else{
                    $input['status_check'] = 10;
                }
                $input['type_approval'] = $type_approval[$k];
                $rs = $model::create($input);
                $i +=1;
                if(!$rs){
                    throw new \Exception('工作流参数数据写入失败');
                }
            }
        }catch (\Exception $e){
            DB::rollBack();
            return redirect()
                ->route('form_design.index')
                ->with([
                    'flash_message' => $e->getMessage()
                ]);
        }
        DB::commit();
        return redirect()
            ->route('form_design.index')
            ->with([
                'flash_message' => '工作流程参数设置成功'
            ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response json
     */
    public function approval(Request $request)
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
