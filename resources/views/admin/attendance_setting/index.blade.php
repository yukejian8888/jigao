@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">考勤规则列表</li>
        </ol>
        考勤规则列表
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('attendance_setting.create')}}" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['attendance_setting.index'],'method' => 'get','class'=>'form-inline']) !!}
                    <div class="input-group pull-right">
                        {!! Form::text('word', '',['class'=>'form-control ','placeholder'=>'名称']) !!}
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
                        <th>ID</th>
                        <th>名称</th>
                        <th>状态</th>
                        <th>签到时间</th>
                        <th>签退时间</th>
                        <th width="280px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $v)
                        <tr class="dogo-remove-{{$v->id}}">
                            <td>{{$v['id']}}</td>
                            <td>{{$v['rule_name']}}</td>
                            <td>{!! Html::radio(['20' => '启用', '10' => '禁用'],$v['status'])!!}</td>
                            <td>{{$v['check_in_time']}}</td>
                            <td>{{$v['check_out_time']}}</td>
                            <td>
                                <div class="dogo-text-links">
                                    <a href="{{route('attendance_setting.edit',['id'=>$v['id']])}}" title="编辑"><i
                                                class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除"
                                       data-url="{{route('attendance_setting.destroy',['id'=>$v['id']])}}"
                                       data-id="{{$v['id']}} " data-title="{{$v->rule_name}}"><i class="fa fa-trash-o">
                                        </i> 删除</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--/--table-responsive-->

        </div>
        <!--/--panel-body-->
        <div class="panel-footer clearfix">

        </div>
    </div>
@endsection