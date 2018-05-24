<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\BlockSortCreateRequest;
use App\Http\Requests\Admin\BlockSortUpdateRequest;
use App\Models\BlockSortModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BlockSortController extends CommonController
{
    protected $fields = [
        'name' =>'',
        'status' =>20,
        'order_by'=>0,
        'keywords'=>'',
        'description'=>'',
        'pid'=>0,
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->skin.'.blocksort.index');
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
        $data['select'] = list_to_tree('block');
        return view($this->skin.'.blocksort.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockSortCreateRequest $request)
    {
        BlockSortModel::create($request->all());
        return redirect()
            ->route('blocksort.index')
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
        $infos = BlockSortModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['select'] = list_to_tree('block');
        $data['id'] = (int)$id;
        return view($this->skin.'.blocksort.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlockSortUpdateRequest $request, $id)
    {
        $children = get_sort_children('block',$id);
        $rules = [
            'pid'=>'not_in:'.$children.$id
        ];
        $messages = [
            'pid.not_in' => '所属分类不可选择自身及子级分类为其父级'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(route('blocksort.edit',$id))
                ->withErrors($validator)
                ->withInput();
        }
        $infos = BlockSortModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('blocksort.index')
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
        $sub_infos = BlockSortModel::where('pid',$id)->get(['id']);
        if(!$sub_infos->isEmpty()){
            $array = array('status'=>'f','code'=>4000,'msg'=>'该分类下存在子级分类不能删除！');
        }else{
            $infos = BlockSortModel::destroy((int)$id);
            if($infos){//1成功
                $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
            }else{//0失败
                $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
            }
        }
        return response()->json($array);
    }
}
