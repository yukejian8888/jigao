<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\AlbumPicCreate;
use App\Http\Requests\Admin\AlbumPicUpdate;
use App\Models\AlbumPicModel;
use App\Models\AlbumSortModel;
use Illuminate\Http\Request;

class AlbumPicController extends CommonController
{
    protected $fields = [
        'id' => '',
        'sort_id' => '0',
        'title' => '',
        'filepath' => '',
        'description' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_id = $request->sort_id;
        $word = '';
        if($request->has('word')){
            $word = $request->word;
            $infos_album_pic = AlbumPicModel::where('title','like','%'.$word.'%')->paginate(15);
        }else{
            $infos_album_pic = AlbumPicModel::where('sort_id',$sort_id)->paginate(18);
        }
        return view($this->skin.'.album_pic.index',compact('infos_album_pic','word','sort_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['sort_id'] = $request->sort_id?$request->sort_id:0;
        return view($this->skin . '.album_pic.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumPicCreate $request)
    {
        $sort_id = $request->get('sort_id');
        $id = $request->get('id');
        $infos = AlbumPicModel::findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('album_pic.index',['sort_id'=>$sort_id])
            ->with([
                'flash_message' => '编辑成功'
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
        $infos = AlbumPicModel::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->skin . '.album_pic.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumPicUpdate $request, $id)
    {
        $sort_id = $request->get('sort_id');
        $infos = AlbumPicModel::findOrFail((int)$id);
//        foreach (array_keys($this->fields) as $field) {
//            $infos->$field = $request->get($field);
//        }
        $infos->title = $request->get('title');
        $infos->description = $request->get('description');
        $infos->save();
        return redirect()
            ->route('album_pic.index',['sort_id'=>$sort_id])
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
        $infos = AlbumPicModel::find((int)$id);
        $infos = object_to_array($infos);
        if($infos['status_lock']=='11'){
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '图片被暂时锁定，不能删除！');
        }elseif($infos['status_lock']=='12'){
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '图片被永久锁定，不能删除！');
        }else{
            $del = AlbumPicModel::destroy((int)$id);
            if ($del) {//1成功
                $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
            } else {//0失败
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
            }
        }

        return response()->json($array);
    }
}
