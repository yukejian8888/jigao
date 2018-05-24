<?php

namespace App\Http\Controllers\Workflow;

use App\Http\Requests\Admin\FormDesignCreate;
use App\Http\Requests\Admin\FormDesignUpdate;
use App\Models\FormDesignModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormDesignController extends CommonController
{
    protected $fields = [
        'title' =>'',
        'sort_id' =>0,
        'content_design' =>'',
        'status_check' =>20,
        'remark' =>'',
        'status_file' =>10
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
        return view($this->skin.'.form_design.index',compact('infos','word'));
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
        return view($this->skin.'.form_design.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormDesignCreate $request)
    {
        $input_all = $request->all();
        $input_all['user_id'] = session('user_id');
        $content = parse_form($input_all['content_design']);
        $input_all['content_design_parse'] = $content['parse'];
        $input_all['content_design_data'] = json_encode($content['data']);
        $input_all['fields'] = $content['fields'];
        $input_all['content_design_parse_all'] = json_encode($content);

        FormDesignModel::create($input_all);

        return redirect()
            ->route('form_design.index')
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
        $infos = FormDesignModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.form_design.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FormDesignUpdate $request, $id)
    {
        $infos = FormDesignModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $input_all = $request->all();
        $content = parse_form($input_all['content_design']);
        $infos['content_design_parse'] = $content['parse'];
        $infos['content_design_data'] = json_encode($content['data']);
        $infos['fields'] = $content['fields'];
        $infos['content_design_parse_all'] = json_encode($content);
        $infos->save();
        return redirect()
            ->route('form_design.index')
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

        $infos = FormDesignModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
