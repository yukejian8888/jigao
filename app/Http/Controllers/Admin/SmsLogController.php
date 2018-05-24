<?php

namespace App\Http\Controllers\Admin;

use App\Models\SmsLogModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsLogController extends CommonController
{
    protected $fields = [
        'phone' => '',
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
            $infos = SmsLogModel::orderBy('id','desc')->where('phone', 'like', '%' . $word . '%')->paginate(15);
        } else {
            $infos = SmsLogModel::orderBy('id','desc')->paginate(15);
        }
        return view($this->skin . '.sms_log.index', compact('infos', 'word'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $infos = SmsLogModel::find((int)$id);
//        $data['id'] = (int)$id;
        return view($this->skin . '.sms_log.show', $infos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infos = SmsLogModel::destroy((int)$id);
        if ($infos) {//1成功
            $array = array('status' => 's', 'code' => 1000, 'msg' => '删除数据操作成功！');
        } else {//0失败
            $array = array('status' => 'f', 'code' => 4000, 'msg' => '删除数据操作失败！');
        }
        return response()->json($array);
    }
}
