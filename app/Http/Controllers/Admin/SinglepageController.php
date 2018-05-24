<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SinglepageCreateRequest;
use App\Http\Requests\Admin\SinglepageUpdateRequest;
use App\Models\SinglepageModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SinglepageController extends CommonController
{
    protected $fields = [
        'title' => '',
        'status' => 20,
        'content' => '',
        'keywords' => '',
        'description' => '',
        'sort_id' => 0
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
            $infos = SinglepageModel::orderBy('id','desc')->where('title', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = SinglepageModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin . '.singlepage.index', compact('infos', 'word'));
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
        return view($this->skin . '.singlepage.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SinglepageCreateRequest $request)
    {
        SinglepageModel::create($request->all());
        return redirect()
            ->route('singlepage.index')
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $infos = SinglepageModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin . '.singlepage.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SinglepageUpdateRequest $request, $id)
    {
        $infos = SinglepageModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('singlepage.index')
            ->with([
                'flash_message' => '编辑成功'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infos = SinglepageModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
