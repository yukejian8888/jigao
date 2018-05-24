<?php
/**
 * Created by PhpStorm.
 * User: cooper
 * Date: 2016/12/10
 * Time: 上午6:05
 */
if (!function_exists('upload_album')) {
    /**
     * 上传图片
     * @return array
     */
    function upload_album(Illuminate\Http\Request $request)
    {
        $infos = array(
            'src'=>'http://adminsir.net/uploads/images/20170802/1501642189_1207901.png',
            'title'=>'',
            'mime'=>'',
            'dirname'=>'',
            'basename'=>'',
            'extension'=>'',
            'filename'=>'',
            'filepath'=>'http://adminsir.net/uploads/images/20170802/1501642189_1207901.png',
            'size'=>1000,
            'width'=>1000,
            'height'=>1000
        );
        $array = array('status' => 's', 'code' => 0,'msg' => '演示站不可上传图片', 'data' => $infos);
        return $array;
        //文件目录是否存在，不存在创建
        $riqi = date("Ymd");
        $path = "./uploads/images/".$riqi;
        if (!file_exists($path)){
            mkdir($path,0777);
        }
        if($request->hasFile('file')):
            $up_path = 'uploads/images/'.$riqi.'/';
            $image = $request->file('file');
            //判断上传的文件的大小
            $filename = time().'_'.rand(1000000,9999999).'.'.$image->getClientOriginalExtension();
            $img = Image::make($image)->save(public_path($up_path.$filename));
            if($img->encoded):
                $infos = array(
                    'src'=>'/'.$up_path.$img->basename,
                    'title'=>$img->filename,
                    'mime'=>$img->mime,
                    'dirname'=>$img->dirname,
                    'basename'=>$img->basename,
                    'extension'=>$img->extension,
                    'filename'=>$img->filename,
                    'filepath'=>'/'.$up_path.$img->basename,
                    'size'=>$image->getSize(),
                    'width'=>$img->width(),
                    'height'=>$img->height()
                );
                //存入数据库
                $model = new \App\Models\AlbumPicModel();
                $input['user_id'] = session('user_id');
                $input['filename'] = $infos['filename'];
                $input['filepath'] = $infos['filepath'];
                $input['size'] = $infos['size'];
                $input['width'] = $infos['width'];
                $input['height'] = $infos['height'];
                $input['mime'] = $infos['mime'];
                $res = $model::create($input);
                $infos['id'] = $res['id'];
                $array = array('status' => 's', 'code' => 0,'msg' => '上传成功', 'data' => $infos);
            else:
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '上传失败！');
            endif;
        else:
            $array = array('status' => 'f', 'code' => 40001, 'msg' => '文件不存在！');
        endif;
        return $array;
    }
}
if (!function_exists('get_image_count_by_sort_id')) {
    /**
     * 上传图片
     * @return array
     */
    function get_image_count_by_sort_id($sort_id)
    {
        $model = new \App\Models\AlbumPicModel();
        $count = $model::where('sort_id',$sort_id)->count();
        return $count;
    }
}