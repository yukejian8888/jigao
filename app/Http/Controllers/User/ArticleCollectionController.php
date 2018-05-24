<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\Admin\ArticleCreateRequest;
use App\Http\Requests\Admin\ArticleUpdateRequest;
use App\Models\ArticleCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleCollectionController extends BaseController
{
    protected $fields = [
        'title' => '',
        'content' => '',
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
            $infos = ArticleCollection::orderBy('id','desc')->where('title', 'like', '%' . $word . '%')->paginate(20);
        } else {
            $infos = ArticleCollection::orderBy('id','desc')->paginate(20);
        }
        return view($this->_skin . '.article_collection.index', compact('infos', 'word'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $infos = ArticleCollection::where('id',$id)->first();
        return view($this->_skin . '.article_collection.show', compact('infos'));
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
        $infos = ArticleCollection::where('id',$id)->first();
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->_skin . '.article_collection.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = session('user_id');
        $infos = ArticleCollection::where('id',$id)->first();
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('user_article_collection.index')
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
        $infos = ArticleCollection::where('id',$id)->delete();
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
