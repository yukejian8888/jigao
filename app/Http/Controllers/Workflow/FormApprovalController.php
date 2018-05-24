<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Requests\Admin\FormApprovalUpdate;
use App\Http\Requests\Admin\FormDataUpdate;
use App\Models\FormDataModel;
use App\Models\FormDesignModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormApprovalController extends CommonController
{
    protected $fields = [
        'form_id' =>0,
        'title' =>'',
        'content' =>'',
        'file' =>'',
        'status_approval' =>0,
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = session('user_id');
        $word = '';
        if($request->has('word')){
            $word = $request->word;
            $infos = FormDataModel::where('title','like','%'.$word.'%')->where('user_id',$user_id)->orderBy('id','desc')->paginate(15);
        }else{
            $infos = FormDataModel::where('user_id',$user_id)->orderBy('id','desc')->paginate(15);
        }
        return view($this->skin.'.form_approval.index',compact('infos','word'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $infos = FormDataModel::where('id',$id)->first();
        $infos = object_to_array($infos);
        $controller = array(
            'action' => 'view'
        );
        $infos_form = unparse_form($infos,'',$controller);
        return view($this->skin.'.form_approval.show',compact('infos','infos_form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //编辑显示页面
    public function edit($id)
    {
        $infos = FormDataModel::where('id',$id)->first();
        $infos = object_to_array($infos);
        $controller = array(
          'action' => 'view'
        );
        $infos_form = unparse_form($infos,'',$controller);

        return view($this->skin.'.form_approval.edit',compact('infos','infos_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //编辑页面提交方法
    public function update(FormDataUpdate $request)
    {
        $input_all = $request->all();
        $id = $request->get('id');
        $infos = $input = FormDataModel::where('id',$id)->first();
        $infos = object_to_array($infos);

        unset($input_all['_method']);
        unset($input_all['_token']);
        //$input = FormDataModel::where('id',$id)->first();
        $input['title'] = $infos['title'];
        $input['content'] = json_encode($input_all);
        $input['content_design'] = $infos['content_design'];
        $input['content_design_parse'] = $infos['content_design_parse'];
        $input['content_design_data'] = $infos['content_design_data'];
        $input['content_design_parse_all'] = $infos['content_design_parse_all'];
        $input['file'] = ''; //上传附件，后期处理成json格式
        $input['fields'] = $infos['fields'];
        $input['status_approval'] = 10;//未提交审批状态

        $input->save();

        return redirect()
            ->route('form_approval.index')
            ->with([
                'flash_message' => '数据编辑成功'
            ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $from_data_id
     * @return \Illuminate\Http\Response
     */
    //发起审批操作
    public function launch(Request $request)
    {
        //初始化审批数据
        $from_data_id = $request->get('from_data_id');
        $infos = FormDataModel::where('id',$from_data_id)->first();
        $infos['status_approval'] = 11;//审批中状态
        $rs = $infos->save();
        if($rs){
            $response = array(
                'status'=>'s',
                'code'=>'1000',
                'msg'=>'审批已提交',
                'url'=>route('form_approval.show',$from_data_id)
            );
        }else{
            $response = array(
                'status'=>'f',
                'code'=>'4000',
                'msg'=>'提交失败，请重新操作'
            );
        }
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除权限验证
        $status = del_destroy('destroy',session('user_role'));
        if($status['code'] == 4000){
            return response()->json($status);
        }
        $infos = FormDataModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);

    }
}

