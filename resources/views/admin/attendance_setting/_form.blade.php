@include('vendor.ueditor.assets')
{!! Html::script('http://api.map.baidu.com/api?v=2.0&ak=BGCNGUayiLlHhPRFCh4Obhd6VTHd2mMN') !!}
{{--加载绘制工具--}}
{!! Html::script('http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js') !!}
{!! Html::style('http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css') !!}
<!--加载检索信息窗口-->
{!! Html::script('http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js') !!}
{!! Html::style('http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css') !!}
<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('forrule_name','考勤组标题',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('rule_name', $rule_name,['class'=>'form-control','placeholder'=>'表单标题']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forstatus','状态',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::multiradio('status',['10' => '禁用', '20' => '启用'],$status) !!}
                </div>
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forneed_attendance_people','需考勤的人员',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <span class="dogo-attendance-people">
                     {{--@php(dump($need_attendance_people))--}}
                    @if($need_attendance_people)
                        @foreach($need_attendance_people as $v)
                            <span class="dogo-warp-approval dogo-js-del-user-id-{{$v}}">
                                <input type="hidden" name="need_attendance_people[]" value="{{$v}}">
                                @php($user = get_user_info($v))
                                @if($user['name']!="")
                                <span class="dogo-border">{{$user['name']}}</span>
                                @endif
                            <i class="fa icon-close dogo-font-close dogo-js-del-approval" data-user-id="{{$v}}"></i>
                                </span>
                        @endforeach
                    @endif
                </span>
                <span class="btn btn-default btn-sm dogo-js-add-approval"><i class="fa fa-plus"></i> </span>
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forcheck_in_time','签到时间',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('check_in_time', $check_in_time,['class'=>'form-control lay_time']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forcheck_out_time','签退时间',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('check_out_time', $check_out_time,['class'=>'form-control lay_time2']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forearliest_time','最早考勤时间',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('earliest_time', $earliest_time,['class'=>'form-control lay_time3']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forallow_late_time','允许最长迟到',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('allow_late_time', $allow_late_time,['class'=>'form-control']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forallow_leave_time','允许早退时间',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('allow_leave_time', $allow_leave_time,['class'=>'form-control']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {{--{!! Form::hidden('address','') !!}--}}
            {!! Form::label('foraddress','地图',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <div id="container" style="height:484px!important;">
                </div>
                <span class="help-block m-b-none">
                <div id="result">
                <input type="button" value="获取绘制的覆盖物个数" onclick="alert(overlays.length)"/>
                <input type="button" value="清除所有覆盖物" onclick="clearOverlays()"/>
            </div>
            </span>
            </div>
            {!! Form::hidden('address', $address,['class'=>'form-control']) !!}


        </div>
    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
</div>
<script>
    //时间插件
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
            elem: '.lay_time'//指定元素
            ,type: 'time'
            ,format:'HH:mm'
        });
        //执行一个laydate实例
        laydate.render({
            elem: '.lay_time2'//指定元素
            ,type: 'time'
            ,format:'HH:mm'
        });
        laydate.render({
            elem: '.lay_time3'//指定元素
            ,type: 'time'
            ,format:'HH:mm'
        });
    });
    //地图插件
    var map = new BMap.Map("container");          // 创建地图实例
    var point = new BMap.Point(120.391655,36.067588);  // 创建点坐标
    map.centerAndZoom("济南市历下区齐鲁文化创意基地", 15);

    //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, {
        isOpen: false, //是否开启绘制模式
        enableDrawingTool: true, //是否显示工具栏
        drawingToolOptions: {
            anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
            offset: new BMap.Size(5, 5), //偏离值
        },
        polylineOptions: styleOptions, //线的样式
        polygonOptions: styleOptions, //多边形的样式
    });
    //鼠标绘制完成回调方法   获取各个点的经纬度
    var overlays = [];
    var overlaycomplete = function(e){
        overlays.push(e.overlay);
        var path = e.overlay.getPath();//Array<Point> 返回多边型的点数组
        $('input[name="address"]').val(JSON.stringify(path));
            for(var i=0;i<path.length;i++){
            console.log("lng:"+path[i].lng+"\n lat:"+path[i].lat);
        }
    };
    //编辑时绘制地图
    var address = '{!! $address !!}';
    if(address){
        console.log('address',address);
        //字符串转对象
        var op = JSON.parse(address);
        console.log(op);
        //添加
        var polylinePointsArray = [];
        var i;
        for (var i in op) {
            var x = op[i].lng;
            var y = op[i].lat;
            polylinePointsArray[i] = new BMap.Point(x,y);
        }
        var first_bmap = new BMap.Point(op[0].lng,op[0].lat);
        polylinePointsArray.push(first_bmap);
        console.log('polylinePointsArray',polylinePointsArray);
        polyline = new BMap.Polyline(polylinePointsArray, {strokeColor:"blue", strokeWeight:3, strokeOpacity:0.5})
        map.addOverlay(polyline);
    }
    var styleOptions = {
        strokeColor:"red",    //边线颜色。
        fillColor:"red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,	   //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    }

    //添加鼠标绘制工具监听事件，用于获取绘制结果
    drawingManager.addEventListener('overlaycomplete', overlaycomplete);
    /*function clearAll() {
        for(var i = 0; i < overlays.length; i++){
            map.removeOverlay(overlays[i]);
        }
        overlays.length = 0;
    }*/
    function clearOverlays() {
        $("input[name='address']").val("");
        map.clearOverlays();
    }
</script>

