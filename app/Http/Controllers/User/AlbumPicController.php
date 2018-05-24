<?php

namespace App\Http\Controllers\User;


use App\Http\Requests\User\AlbumPicCreate;
use App\Http\Requests\User\AlbumPicUpdate;
use App\Models\AlbumPicModel;
use Illuminate\Http\Request;

class AlbumPicController extends BaseController
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
        $user_id = session('user_id');
        $sort_id = $request->sort_id;
        $word = '';
        if($request->has('word')){
            $word = $request->word;
            $infos_album_pic = AlbumPicModel::where('title','like','%'.$word.'%')->where('user_id',$user_id)->paginate(15);
        }else{
            $infos_album_pic = AlbumPicModel::where('sort_id',$sort_id)->where('user_id',$user_id)->paginate(18);
        }
        return view($this->_skin.'.album_pic.index',compact('infos_album_pic','word','sort_id'));
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
        return view($this->_skin . '.album_pic.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumPicCreate $request)
    {
        $user_id = session('user_id');
        $sort_id = $request->get('sort_id');
        $id = $request->get('id');
        $infos = AlbumPicModel::where('user_id',$user_id)->findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('u_album_pic.index',['sort_id'=>$sort_id])
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
    public function edit(Request $request,$id)
    {
        $user_id = session('user_id');
        $infos = AlbumPicModel::where('user_id',$user_id)->find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->_skin . '.album_pic.edit', $data);
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
        $user_id = session('user_id');
        $sort_id = $request->get('sort_id');
        $infos = AlbumPicModel::where('user_id',$user_id)->findOrFail((int)$id);
//        foreach (array_keys($this->fields) as $field) {
//            $infos->$field = $request->get($field);
//        }
        $infos->title = $request->get('title');
        $infos->description = $request->get('description');
        $infos->save();
        return redirect()
            ->route('u_album_pic.index',['sort_id'=>$sort_id])
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
        $infos = AlbumPicModel::where('user_id',$user_id)->find((int)$id);
        $infos = object_to_array($infos);
        if($infos['status_lock']=='11'){
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '图片被暂时锁定，不能删除！');
        }elseif($infos['status_lock']=='12'){
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '图片被永久锁定，不能删除！');
        }else{
            $del = AlbumPicModel::where('user_id',$user_id)->where('id',$id)->delete();
            if ($del) {//1成功
                $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
            } else {//0失败
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
            }
        }

        return response()->json($array);
    }
}
