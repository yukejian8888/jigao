@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            短信发送记录管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">短信发送记录管理</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-danger">
                <div class="box-header">

                    <div class="row">
                        <div class="col-sm-2">
                            <h5>短信发送记录列表</h5>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-1">
                            <a href="{{route('sms_log.index')}}" class="btn btn-default btn-sm pull-right"><i class="fa fa-list "></i>&nbsp;查看</a>
                        </div>

                        {!! Form::open(['route' => ['sms_log.index'],'method' => 'get']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('word', '',['class'=>'form-control pull-right input-sm','placeholder'=>'手机号码']) !!}
                        </div>
                        <div class="col-sm-1">
                            {!! Form::submit('查询',['class'=>'btn btn-default pull-right btn-block btn-sm','type'=>'submit']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>手机号码</th>
                            <th>发送类型</th>
                            <th>发送状态</th>
                            <th>发送开始时间</th>
                            <th>发送完成时间</th>
                            <th>服务商</th>
                            <th>验证码</th>
                            <th>验证状态</th>
                            <th>验证时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($infos as $item)
                            <tr class="dogo-remove-{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{!! Html::radio(['11' => '短信通知', '10' => '短信验证码'],$item->type_send)!!}</td>
                                <td>{!! Html::radio(['11' => '成功', '10' => '失败'],$item->status_send)!!}</td>
                                <td>{{$item->started_at}}</td>
                                <td>{{$item->finished_at}}</td>
                                <td>{{$item->driver}}</td>
                                <td>{{$item->code}}</td>
                                <td>{!! Html::radio(['10' => '未验证', '11' => '已验证', '12' => '验证失败'],$item->status_check)!!}</td>
                                <td>{{$item->check_at}}</td>
                                <td>
                                    <a href="{{route('sms_log.show',['id'=>$item['id']])}}" title="查看"><i class="fa fa-eye"> </i></a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('sms_log.destroy',['id'=>$item['id']])}}" data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->



                <div class="box-footer clearfix">

                    {{ $infos->appends(['word'=>$word])->links('partials.common.pagination') }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    </section>
@endsection