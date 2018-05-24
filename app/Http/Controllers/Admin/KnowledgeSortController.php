<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\KnowledgeSortCreate;
use App\Http\Requests\Admin\KnowledgeSortUpdate;
use App\Models\KnowledgeSortModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KnowledgeSortController extends CommonController
{
    protected $fields = [
        'name' =>'',
        'status' =>20,
        'order_by'=>0,
        'keywords'=>'',
        'description'=>'',
        'pic'=>'',
        'tpl_list'=>'',
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
            $infos = KnowledgeSortModel::orderBy('id', 'desc')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = KnowledgeSortModel::orderBy('id', 'desc')->paginate(15);
        }
        return view($this->skin.'.knowledge_sort.index', compact('infos', 'word'));
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
        return view($this->skin.'.knowledge_sort.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeSortCreate $request)
    {
        $input = $request->all();
        $input['user_id'] = session('user_id');
        KnowledgeSortModel::create($input);
        return redirect()
            ->route('knowledge_sort.index')
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
        $infos = KnowledgeSortModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin.'.knowledge_sort.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KnowledgeSortUpdate $request, $id)
    {
        $infos = KnowledgeSortModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('knowledge_sort.index')
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
        $infos = KnowledgeSortModel::destroy((int)$id);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
        }
        return response()->json($array);
    }
}
