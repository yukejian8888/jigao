<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Requests\Admin\FormDataCreate;
use App\Http\Requests\Admin\FormDataUpdate;
use App\Models\FormDataModel;
use App\Models\FormDesignModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormDataController extends CommonController
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
        $word = '';
        if($request->has('word')){
            $word = $request->word;
            $infos = FormDesignModel::where('title','like','%'.$word.'%')->paginate(15);
        }else{
            $infos = FormDesignModel::paginate(15);
        }
        return view($this->skin.'.form_data.index',compact('infos','word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $form_id = $request->get('form_id');
        $infos = FormDesignModel::where('id',$form_id)->first();
        $infos = object_to_array($infos);
        //
        //dump($infos);exit;
        //$infos['content'] = parse_form($infos['content_design']);
        //dump($infos)
        $controller = array(
            'action' => 'view'
        );
        $infos_form = unparse_form($infos,'',$controller);
        return view($this->skin.'.form_data.create',compact('infos','infos_form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormDataCreate $request)
    {
        $input_all = $request->all();
        $form_id = $request->get('form_id');
        $infos = FormDesignModel::where('id',$form_id)->first();
        $infos = object_to_array($infos);
        unset($input_all['_token']);
        $input['form_id'] = $infos['id'];
        $input['title'] = $infos['title'];
        $input['content'] = json_encode($input_all);
        $input['content_design'] = $infos['content_design'];
        $input['content_design_parse'] = $infos['content_design_parse'];
        $input['content_design_data'] = $infos['content_design_data'];
        $input['content_design_parse_all'] = $infos['content_design_parse_all'];
        $input['file'] = ''; //上传附件，后期处理成json格式
        $input['fields'] = $infos['fields'];
        $input['status_approval'] = 10;
        FormDataModel::create($input);

        return redirect()
            ->route('form_data.index')
            ->with([
                'flash_message' => '数据添加成功'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = FormDataModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.form_data.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormDataUpdate $request, $id)
    {
        $infos = FormDataModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $input_all = $request->all();
        $content = parse_form($input_all['content_design']);
        $input_all['content_design_parse'] = $content['parse'];
        $input_all['content_design_data'] = json_encode($content['data']);
        $input_all['fields'] = $content['fields'];
        $input_all['content_design_parse_all'] = json_encode($content);
        $infos->save();
        return redirect()
            ->route('form_data.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
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
