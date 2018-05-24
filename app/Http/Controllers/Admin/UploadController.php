<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Image;

class UploadController extends CommonController
{
    /**
     * 上传图片终极解决方案
     */
    public function upload(Request $request)
    {
        $response = upload_album($request);
        return response()->json($response)->header('Content-Type','text/html;charset=utf-8');
    }

}
