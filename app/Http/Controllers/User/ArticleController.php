<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Admin\ArticleCreateRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\ArticleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends BaseController
{
    protected $fields = [
        'title' => '',
        'subtitle' => '',
        'source_url' => '',
        'flag' => array(),
        'status_publish' => 20,
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
        $user_id = session('user_id');
        $word = '';
        if ($request->has('word')) {
            $word = $request->word;
            $infos = ArticleModel::where('user_id',$user_id)->orderBy('id','desc')->where('title', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = ArticleModel::where('user_id',$user_id)->orderBy('id','desc')->paginate(15);
        }
        return view($this->_skin . '.article.index', compact('infos', 'word'));
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
        return view($this->_skin . '.article.create', $data);
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
        $input['status'] = 20;//默认审核通过
        ArticleModel::create($input);
        return redirect()
            ->route('user_article.index')
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
        $user_id = session('user_id');
        $infos = ArticleModel::where('user_id',$user_id)->where('id',$id)->first();
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        $data['flag'] = explode(',',$infos['flag']);
        return view($this->_skin . '.article.edit', $data);
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
        $user_id = session('user_id');
        $infos = ArticleModel::where('user_id',$user_id)->where('id',$id)->first();
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        if(!empty($request['flag'])){
            $infos['flag'] = implode($request['flag'],',');
        }else{
            $infos['flag'] = '';
        }
        $infos['status'] = 20;//默认审核通过
        $infos->save();
        return redirect()
            ->route('user_article.index')
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
        $user_id = session('user_id');
        $infos = ArticleModel::where('user_id',$user_id)->where('id',$id)->delete();
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
