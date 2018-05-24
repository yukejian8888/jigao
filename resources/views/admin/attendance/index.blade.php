@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">考勤管理</li>
        </ol>
        考勤统计
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('attendance.create')}}" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['attendance.index'],'method' => 'get','class'=>'form-inline']) !!}
                    <div class="input-group pull-right">
                        {!! Form::text('word', '',['class'=>'form-control ly_time','placeholder'=>'日期']) !!}
                        <span class="input-group-btn">
                            {!! Form::submit('查询',['class'=>'btn btn-default  ','type'=>'submit']) !!}
                        </span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div><!--row-->
        </div>
        <!--panel-heading-->
        <div class="panel-body">
            <div class="table-responsive no-padding">
                <table class="table  table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>日期</th>
                        <th>姓名</th>
                        <th>签到时间</th>
                        <th>签退时间</th>
                        <th>应到</th>
                        <th width="150px">查看</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $v)
                        <tr>
                            <td>{{$v['now_time']}}</td>
                            <td>{{$v['user_id']}}</td>
                            <td>{{$v['check_in_time']}}</td>
                            <td>{{$v['check_out_time']}}</td>
                            <td>{{$v['status_should']}}</td>
                            <td>编辑|删除</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <!--/--table-responsive-->

        </div>
        <div class="col-md-6">
            <a href="{{route('attendance.create')}}" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-share"></i></span>导出表</a>
        </div>
        <!--/--panel-body-->
        <div class="panel-footer clearfix">

        </div>
    </div>
    <script type="text/javascript">
        //时间插件(年月)
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '.ly_time'
                , type: 'month'
            })
        });
    </script>
@endsection