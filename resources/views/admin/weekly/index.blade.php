@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">工作周报列表</li>
        </ol>
        工作周报列表
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    <!-- Main content -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('weekly.create')}}" class="btn btn-labeled btn-info"><span
                                class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['weekly.index'],'method' => 'get','class'=>'form-inline']) !!}
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
        <!-- /.box-header -->
        <div class="panel-body">
            <div class="table-responsive no-padding">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>周报名称</th>
                        <th>项目名称</th>
                        <th>会员名称</th>
                        <th>创建时间</th>
                        <th>计划备注</th>
                        <th width="180px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $item)
                        <tr class="dogo-remove-{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            @php($weekly = get_weekly_item_by_weekly_id($item->id))
                            <td>
                                @foreach($weekly as $k=>$v)
                                  {{$v['project_name']}}<br />
                                @endforeach
                            </td>
                            @php($user = get_user_info($item->user_id))
                            <td>{{$user['name']}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->plan_remark}}</td>
                            <td>
                                @if($item['submit_status'] === 10)
                                    <a href="{{route('weekly.edit',['id'=>$item['id']])}}" title="编辑"><i
                                                class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-reported" data-title="{{$item->title}}" title="上报" reported-data-id="{{$item->id}}"><i class="fa fa-external-link"> </i> 上报</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('weekly.destroy',['id'=>$item['id']])}}" data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
                                @elseif($item['submit_status'] === 11)
                                    <a href="{{route('weekly.reportedit',['id'=>$item['id']])}}" title="汇报编辑"><i
                                                class="fa fa-edit"> </i> 汇报编辑</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-report" data-title="{{$item->title}}" title="汇报" report-data-id="{{$item->id}}"><i class="fa fa-external-link"> </i> 汇报</a>&nbsp;
                                @else
                                    <a href="{{route('weekly.show',['id'=>$item['id']])}}" title="查看"><i
                                                class="fa fa-eye"> </i> 查看</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.box-body -->


        <div class="box-footer clearfix">

            {{ $infos->appends(['word'=>$word])->links('partials.common.pagination') }}
        </div>
        <!-- /.box -->
    </div>
    <script>
        $(document).ready(function(){
            // 上报
            $(".dogo-click-reported").click(function(){
                var reported_data_id = $(this).attr('reported-data-id')
                var data_title = $(this).attr('data-title');
                var url = "{{route('admin.weekly.reported')}}";
                layer.confirm('确定要上报【'+data_title+'】吗?', {icon: 3, title:'提示'}, function(index){
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{
                            reported_data_id:reported_data_id
                        },
                        dataType:'json',
                        beforeSend:function () {
                            layer.load(2);
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(response){
                            layer.closeAll('loading');
                            layer.msg(response.msg);
                            if(response.status=='s'){
                                window.location.reload();
                            }else{
                                layer.msg(response.msg);
                            }
                        }
                    })
                    layer.close(index);
                },function (index) {
                    layer.close(index);
                });

            })

            //汇报
            $(".dogo-click-report").click(function(){
                var report_data_id = $(this).attr('report-data-id')
                var data_title = $(this).attr('data-title');
                var url = "{{route('admin.weekly.report')}}";
                layer.confirm('确定要汇报【'+data_title+'】吗?', {icon: 3, title:'提示'}, function(index){
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{
                            report_data_id:report_data_id
                        },
                        dataType:'json',
                        beforeSend:function () {
                            layer.load(2);
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success:function(response){
                            layer.closeAll('loading');
                            layer.msg(response.msg);
                            if(response.status=='s'){
                                window.location.reload();
                            }else{
                                layer.msg(response.msg);
                            }
                        }
                    })
                    layer.close(index);
                },function (index) {
                    layer.close(index);
                });

            })
        })
    </script>
@endsection