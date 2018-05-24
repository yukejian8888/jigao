<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\AlbumSortCreate;
use App\Http\Requests\User\AlbumSortUpdate;
use App\Models\AlbumPicModel;
use App\Models\AlbumSortModel;
use Illuminate\Http\Request;

class AlbumSortController extends BaseController
{
    protected $fields = [
        'name' =>'',
        'description' =>''
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
        $sort_id = 0;
        if($request->has('word')){
            $word = $request->word;
            $infos_album_pic = AlbumPicModel::where('title','like','%'.$word.'%')->where('user_id',$user_id)->paginate(15);
        }else{
            $infos_album_pic = AlbumPicModel::where('sort_id',$sort_id)->where('user_id',$user_id)->paginate(18);
        }
        $infos_album_sort = AlbumSortModel::where('user_id',$user_id)->get();
        return view($this->_skin.'.album_sort.index',compact('infos_album_sort','infos_album_pic','word','sort_id'));
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
        return view($this->_skin.'.album_sort.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumSortCreate $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = session('user_id');
        AlbumSortModel::create($inputs);
        return redirect()
            ->route('u_album_sort.index')
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
        $user_id = session('user_id');
        $infos = AlbumSortModel::where('user_id',$user_id)->find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $infos->$field);
        }
        $data['id'] = (int)$id;
        return view($this->_skin.'.album_sort.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumSortUpdate $request, $id)
    {
        $user_id = session('user_id');
        $infos = AlbumSortModel::where('user_id',$user_id)->findOrFail((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $infos->$field = $request->get($field);
        }
        $infos->save();
        return redirect()
            ->route('u_album_sort.index')
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
        $user_id = session('user_id');
        //通过$id，查询是否包含图片信息，如果包含禁止删除操作
        $infos_pic = AlbumPicModel::where('user_id',$user_id)->where('sort_id',$id)->first();
        if($infos_pic){
            $array = array('status'=>'f','code'=>4000,'msg'=>'相册下包含有图片，禁止删除！');
        }else{
            $infos = AlbumSortModel::where('user_id',$user_id)->destroy((int)$id);
            if($infos){//1成功
                $array = array('status'=>'s','code'=>1000,'msg'=>'删除数据操作成功！');
            }else{//0失败
                $array = array('status'=>'f','code'=>4000,'msg'=>'删除数据操作失败！');
            }
        }

        return response()->json($array);
    }
}
