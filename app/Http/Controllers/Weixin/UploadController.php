<?php

namespace App\Http\Controllers\Weixin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class UploadController extends BaseController
{
    /**
     * 上传头像
     */
    public function upload_avatar(Request $request)
    {
        $image = $request->file('file');
        $dirname = 'avatar';
        if($request->hasFile('file')):
            $up_path = 'uploads/'.$dirname.'/';
            $image = $request->file('file');
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
                );
                $array = array('status' => 's', 'code' => 0,'msg' => '上传成功', 'data' => $infos);
            else:
                $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
            endif;
        else:
            $array = array('status' => 'f', 'code' => 40001, 'msg' => '文件不存在！');
        endif;
        return response()->json($array)->header('Content-Type','text/html;charset=utf-8');
    }
}
