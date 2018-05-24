<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ArticleCreateRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\ArticleModel;
use App\Models\ArticleSortModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends CommonController
{
    protected $fields = [
        'title' => '',
        'subtitle' => '',
        'flag' => array(),
        'status' => 20,
        'content' => '',
        'keywords' => '',
        'description' => '',
        'pic' => '',
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
            $infos = ArticleModel::orderBy('id','desc')->where('title', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = ArticleModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin . '.article.index', compact('infos', 'word'));
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
        //$data['article'] = $this->article;
        $model = new ArticleSortModel();
        $data['article'] = get_select_menu_k_v("首级分类",$model,"name");
        return view($this->skin . '.article.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $input = $request->all();
        if(!empty($request['flag'])){
            $input['flag'] = implode($request['flag'],',');
        }else{
            $input['flag'] = '';
        }
        $input['user_id'] = session('user_id');
        ArticleModel::create($input);
        return redirect()
            ->route('article.index')
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
        $infos = ArticleModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        $data['flag'] = explode(',',$infos['flag']);
        $model = new ArticleSortModel();
        $data['article'] = get_select_menu_k_v("首级分类",$model,"name");
        return view($this->skin . '.article.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {
        $infos = ArticleModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if(!empty($request['flag'])){
            $infos['flag'] = implode($request['flag'],',');
        }else{
            $infos['flag'] = '';
        }
        $infos->save();
        return redirect()
            ->route('article.index')
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
        $infos = ArticleModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
