<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttendanceModel;
use App\Models\AttendanceSettingModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;
use PHPExcel;
use PHPExcel_IOFactory;

class AttendanceController extends CommonController
{
    protected $fields = [
        'user_id' =>'',
        'now_time' =>'',
        'status_work'=>'',
        'check_in_time'=>'',
        'check_out_time'=>'',
        'status_should'=>'',
        'status_really'=>'',
        'over_time'=>'',
        'status_over_time'=>'',
        'is_click'=>'',
        'ip'=>'',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('word')) {
            $word = $request->word;
            $infos = AttendanceModel::orderBy('id','desc')->where('now_time', 'like', '%' . $word . '%')
                ->paginate(15);
        } else {
            $infos = AttendanceModel::orderBy('id','desc')->paginate(15);
        }
        //PHPExcel
        //require (app_path() . '/Tools/MyTest.php');
//        require (app_path() . '.\vendor\phpoffice\phpexcel\Classes\PHPExcel.php');
        // 首先创建一个新的对象  PHPExcel object
        $objPHPExcel = new \PHPExcel();
        // 设置文件的一些属性，在xls文件——>属性——>详细信息里可以看到这些值，xml表格里是没有这些值的
        $objPHPExcel->getProperties();
        $objPHPExcel
            ->getProperties()  //获得文件属性对象，给下文提供设置资源
            ->setCreator( "ly")     //设置文件的创建者
            ->setLastModifiedBy( "ly")    //设置最后修改者
            ->setTitle( "Office 2007 XLSX Test Document" )    //设置标题
            ->setSubject( "Office 2007 XLSX Test Document" )  //设置主题
            ->setDescription( "Test document for Office 2007 XLSX, generated using PHP classes.") //设置备注
            ->setKeywords( "office 2007 openxml php")        //设置标记
            ->setCategory( "Test result file");               //设置类别
//        dump($c);
//        exit();
        // 位置aaa  *为下文代码位置提供锚
        // 给表格添加数据
        $b = $objPHPExcel->setActiveSheetIndex(0)             //设置第一个内置表（一个xls文件里可以有多个表）为活动的
                    ->setCellValue( 'A1', 'Hello' )                     //给表的单元格设置数据
                    ->setCellValue( 'B2', 'world!' )                    //数据格式可以为字符串
                    ->setCellValue( 'C1', 12)            //数字型
                    ->setCellValue( 'D2', 12)            //
                    ->setCellValue( 'D3', true )        //布尔型
                    ->setCellValue( 'D4', '=SUM(C1:D2)' );//公式
        //得到当前活动的表,注意下文教程中会经常用到$objActSheet
        $objActSheet = $objPHPExcel->getActiveSheet();
        // 位置bbb  *为下文代码位置提供锚
        // 给当前活动的表设置名称
        $objActSheet->setTitle('Simple2222');
        //代码还没有结束，可以复制下面的代码来决定我们将要做什么
        //我们将要做的是
        //直接生成一个文件
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('myexchel.xlsx');
        //2、提示下载文件
        //excel 2003 .xls
        // 生成2003excel格式的xls文件
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        //$q = new \PHPExcel_IOFactory();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
        //excel 2007 .xlsx
        // 生成2007excel格式的xlsx文件
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory:: createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save( 'php://output');
        exit;

        //PHPExcel end
        return view($this->skin . '.attendance.index', compact('infos', 'word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlockSortUpdateRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //删除权限验证
        $status = del_destroy('destroy',session('user_role'));
        if($status['code'] == 4000){
            return response()->json($status);
        }

    }
    /**
     * 考勤打卡 签到
     */
    public function punch(){
        $input = [];
        $input['user_id'] = session("user_id");
        $input['now_time'] = time();
        $input['status_check_in'] = 10;
        $input['ip'] = get_client_ip();
        $input['check_in_time'] = time();
        $input['is_click'] = 10;
        //查询当前登录用户用的哪个规则
        $rule =AttendanceSettingModel::orderBy('id','desc')->where("need_attendance_people",'like','%'.$input['user_id'].'%')->first();
        //对象转换成数组
        $rule = object_to_array($rule);
        //输出签到的日期，例如2017-09-29
        $date = date('Y-m-d',$input['check_in_time']);
        //需要比对的时间 转换成时间戳
        $rule_time = strtotime($date.$rule['check_in_time']);
        //计算相差的小时数
        $difference_time = round((($input['check_in_time'] - $rule_time)/(60)),2);
        $infos = AttendanceModel::create($input);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'签到成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'签到失败！');
        }
        return response()->json($array);
    }
    /**
     * 签退
     */
    public function checkout(){
        //根据当前用户，当前时间查询attendance表中唯一确定一条数据
        $date = time();
        $now = date('Y-m-d');
        $id = session("user_id");
        $infos = AttendanceModel::orderBy('id','desc')
                ->where(['user_id'=>$id])
                ->where('created_at','like',$now.'%')
                ->update(['check_out_time' => $date]);
        if($infos){//1成功
            $array = array('status'=>'s','code'=>1000,'msg'=>'签退成功！');
        }else{//0失败
            $array = array('status'=>'f','code'=>4000,'msg'=>'签退失败！');
        }
        return response()->json($array);
    }
}
