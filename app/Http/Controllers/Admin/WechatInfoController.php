<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WechatInfoCreateRequest;
use App\Http\Requests\Admin\WechatInfoUpdateRequest;
use App\ModelsWechat\WechatInfoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatInfoController extends CommonController
{
    protected $fields = [
        'title' =>'',
        'keyword' =>'',
        'pic' =>'',
        'url' =>'',
        'status' =>20,
//        'is_default' =>10,
        'type_reply_info' =>15,
        'type_event' =>20,
        'type_event_key' =>array(),
        'order_by' =>0,
        'content' =>'',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $infos = WechatInfoModel::orderBy('id','desc')->paginate(15);

        return view($this->skin.'.wechat_info.index',compact('infos'));
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
        $data['select_type_event_key'] = get_wechat_menu_key();//checkbox
        return view($this->skin.'.wechat_info.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WechatInfoCreateRequest $request)
    {
        $infos = $request->all();
        if(!empty($request['type_event_key'])){
            $infos['type_event_key'] = implode($request['type_event_key'],',');
        }else{
            $infos['type_event_key'] = '';
        }
        WechatInfoModel::create($infos);
        return redirect()
            ->route('wechat_info.index')
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
        $infos = WechatInfoModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['select_type_event_key'] = get_wechat_menu_key();//checkbox
        $data['type_event_key'] = explode(',',$infos['type_event_key']);
        $data['id'] = (int)$id;
        return view($this->skin.'.wechat_info.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WechatInfoUpdateRequest $request, $id)
    {
        $infos = WechatInfoModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if(!empty($request['type_event_key'])){
            $infos['type_event_key'] = implode($request['type_event_key'],',');
        }else{
            $infos['type_event_key'] = '';
        }
        $infos->save();
        return redirect()
            ->route('wechat_info.index')
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
        $infos = WechatInfoModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
