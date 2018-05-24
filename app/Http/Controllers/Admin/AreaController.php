<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AreaCreateRequest;
use App\Http\Requests\Admin\AreaUpdateRequest;
use App\Models\AreaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AreaController extends CommonController
{
    protected $fields = [
        'name' =>'',
        'pinyin' =>'',
        'pid' =>0,
        'keywords' =>'',
        'description' =>'',
        'order_by' =>0,
        'status' =>20
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $word = '';
        $pid = 0;
        if($request->has('word')){
            $word = $request->word;
            $infos = AreaModel::where('name','like','%'.$word.'%')->paginate(15);
        }else{
            if($request->has('pid')){
                $pid = $request->pid;
            }
            $infos = AreaModel::where('pid',$pid)->paginate(15);
        }
        return view($this->skin.'.area.index',compact('infos','word','pid'));
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
        return view($this->skin.'.area.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaCreateRequest $request)
    {
        AreaModel::create($request->all());
        return redirect()
            ->route('area.index')
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
        $infos = AreaModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['select'] = list_to_tree('area');
        $data['id'] = (int)$id;
        return view($this->skin.'.area.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaUpdateRequest $request, $id)
    {
        $children = get_sort_children('area',$id);
        $rules = [
            'pid'=>'not_in:'.$children.$id
        ];
        $messages = [
            'pid.not_in' => '所属分类不可选择自身及子级分类为其父级'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect(route('area.edit',$id))
                ->withErrors($validator)
                ->withInput();
        }
        $infos = AreaModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('area.index')
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
        $infos = AreaModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
