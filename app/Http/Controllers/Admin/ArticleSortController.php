<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleSortCreateRequest;
use App\Http\Requests\Admin\ArticleSortUpdateRequest;
use App\Models\ArticleSortModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ArticleSortController extends CommonController
{
    protected $fields = [
        'name' => '',
        'status' => 20,
        'order_by' => 0,
        'keywords' => '',
        'description' => '',
        'pid' => 0,
        'pic' => '',
        'tpl_list' => '',
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
            $infos = ArticleSortModel::orderBy('id', 'desc')->where('name', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = ArticleSortModel::orderBy('id', 'desc')->paginate(15);
        }
        //无限极分类
        $infos = infiniteclass($infos,0,0);

        return view($this->skin . '.articlesort.index', compact('infos', 'word'));
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
        $model = new ArticleSortModel();
        $data['articlesort'] = get_select_menu_k_v("首级分类",$model,"name");
        return view($this->skin . '.articlesort.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleSortCreateRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = session('user_id');
        ArticleSortModel::create($input);
        return redirect()
            ->route('articlesort.index')
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
        $infos = ArticleSortModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        $model = new ArticleSortModel();
        $data['articlesort'] = get_select_menu_k_v("首级分类",$model,"name");
        return view($this->skin . '.articlesort.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleSortUpdateRequest $request, $id)
    {
        $children = get_sort_children('article', $id);
        $rules = [
            'pid' => 'not_in:' . $children . $id
        ];
        $messages = [
            'pid.not_in' => '所属分类不可选择自身及子级分类为其父级'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect(route('articlesort.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }
        $infos = ArticleSortModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('articlesort.index')
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
        //删除权限验证
        $status = del_destroy('destroy',session('user_role'));
        if($status['code'] == 4000){
            return response()->json($status);
        }
        //验证当前分类下是否包含子分类
        $sub_infos = ArticleSortModel::where('pid', $id)->get(['id']);
        if (!$sub_infos->isEmpty()) {
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '该分类下存在子级分类不能删除！');
        } else {
            $infos = ArticleSortModel::destroy((int)$id);
            if ($infos) {//1成功
                $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
            } else {//0失败
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
            }
        }
        return response()->json($array);
    }
}
