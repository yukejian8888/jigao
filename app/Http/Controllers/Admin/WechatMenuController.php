<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\WechatMenuCreateRequest;
use App\Http\Requests\Admin\WechatMenuUpdateRequest;
use App\ModelsWechat\WechatMenuModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class WechatMenuController extends CommonController
{
    protected $fields = [
        'name' =>'',
        'status' =>20,
        'order_by'=>0,
        'key'=>0,
        'type'=>'click',
        'url'=>'',
        'pid'=>0,
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->skin.'.wechat_menu.index');
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
        return view($this->skin.'.wechat_menu.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WechatMenuCreateRequest $request)
    {
        $input = $request->all();
        $input['key'] = get_uuid();
        //如果$pid=0，验证父级，如果不为0验证子级
        //通过pid获取数据条数，并将数据传递给一个字段，为0~3，0~5
        $pid = $input['pid'];
        $count = WechatMenuModel::where('pid',$pid)->count();
        if($pid==0)://0时是一级菜单
            if($count>=3):
                return redirect(route('wechat_menu.create'))
                    ->withErrors('微信一级菜单最多能设置3个')
                    ->withInput();
            endif;
        else://不为0时，二级菜单
            $info_tree = WechatMenuModel::find((int)$pid);
            if($info_tree['pid']!=0):
                return redirect(route('wechat_menu.create'))
                    ->withErrors('[所属菜单]-微信自定义菜单仅支持最多二级菜单')
                    ->withInput();
            endif;
            if($count>=5):
                return redirect(route('wechat_menu.create'))
                    ->withErrors('微信二级菜单最多能设置5个')
                    ->withInput();
            endif;
        endif;
        WechatMenuModel::create($input);
        return redirect()
            ->route('wechat_menu.index')
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
        $infos = WechatMenuModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['select'] = list_to_tree('block');
        $data['id'] = (int)$id;
        return view($this->skin.'.wechat_menu.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WechatMenuUpdateRequest $request, $id)
    {
        //判断不可选择自身及子级为父级分类
        $children = get_sort_children('wechat_menu',$id);
        $rules = [
            'pid'=>'not_in:'.$children.$id
        ];
        $messages = [
            'pid.not_in' => '所属分类不可选择自身及子级分类为其父级'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(route('wechat_menu.edit',$id))
                ->withErrors($validator)
                ->withInput();
        }

        $pid = $request->get('pid');
        $info_all = WechatMenuModel::where('pid',$pid)->get(['id']);
        $array_id = array();
        foreach ($info_all as $k=>$v){
            $array_id[] = $v['id'];
        }
        $a = array_unique(array_merge($array_id,array($id)));//合并数组，并去重
        $count_array = count($a);//计算个数
        if($pid==0)://0时是一级菜单
            if($count_array>=4):
                return redirect(route('wechat_menu.edit',$id))
                    ->withErrors('微信一级菜单最多能设置3个')
                    ->withInput();
            endif;
        else://不为0时，二级菜单
            $info_tree = WechatMenuModel::find((int)$pid);
            if($info_tree['pid']!=0):
                return redirect(route('wechat_menu.edit',$id))
                    ->withErrors('[所属菜单]-微信自定义菜单仅支持最多二级菜单')
                    ->withInput();
            endif;
            $info_sub = WechatMenuModel::where('pid',$id)->first();
            if(!empty($info_sub)):
                return redirect(route('wechat_menu.edit',$id))
                    ->withErrors('[所属菜单]-微信自定义菜单仅支持最多二级菜单')
                    ->withInput();
            endif;
            if($count_array>=6):
                return redirect(route('wechat_menu.edit',$id))
                    ->withErrors('微信二级菜单最多能设置5个')
                    ->withInput();
            endif;
        endif;

        $infos = WechatMenuModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('wechat_menu.index')
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
        //验证当前分类下是否包含子分类
        $sub_infos = WechatMenuModel::where('pid',$id)->get(['id']);
        if(!$sub_infos->isEmpty()){
            $array = array('status'=>'f','code'=>4000,'msg'=>'该分类下存在子级分类不能删除！');
        }else{
            $infos = WechatMenuModel::destroy((int)$id);
            if($infos){//1成功
                $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
            }else{//0失败
                $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
            }
        }
        return response()->json($array);
    }

    /**
     * wechat_menu_create
     * 创建自定义菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechat_menu_create()
    {
        $array = wechat_menu_create();
        return response()->json($array);
    }
    /**
     * wechat_menu_delete
     * 删除自定义菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechat_menu_delete()
    {
        $array = wechat_menu_delete();
        return response()->json($array);
    }
    /**
     * wechat_menu_list
     * 查看所有自定义菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function wechat_menu_list()
    {
        $array = wechat_menu_list();
        return response()->json($array);
    }
}
