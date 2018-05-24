@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">我的审批单列表</li>
        </ol>
        我的审批单列表
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['form_approval.index'],'method' => 'get','class'=>'form-inline']) !!}
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
                        <th>项目名称</th>
                        <th>状态</th>
                        <th>创建日期</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $item)
                        <tr class="dogo-remove-{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{!! Html::radio(['20' => '已审批', '10' => '待审批','11' => '审批中','12' => '已驳回'],$item->status_approval)!!}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <div class="dogo-text-links">
                                    @if($item['status_approval'] == 10)
                                        <a href="javascript:void(0)" data-from-data-id="{{$item['id']}}" title="发起审批" class="dogo-js-launch-approval"><i class="fa icon-plus"></i> 发起审批</a>
                                        <a href="{{route('form_approval.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>
                                        <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('form_approval.destroy',['id'=>$item['id']])}}" data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
                                    @elseif($item['status_approval'] == 11)
                                        <a href="{{route('form_approval.show',['id'=>$item['id']])}}" title="审批流程"><i class="fa fa-eye"> </i> 审批流程</a>
                                        <a href="{{route('form_approval.show',['id'=>$item['id']])}}" title="审批记录"><i class="fa fa-eye"> </i> 审批记录</a>
                                    @endif
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
            {{ $infos->appends(['word'=>$word])->links('partials.common.pagination') }}
        </div>
    </div>
    <script>
        $(function () {
            $('.dogo-js-launch-approval').click(function () {
                var from_data_id = $(this).attr('data-from-data-id');
                var url = "{{route('admin.form_approval.launch')}}";
                $.ajax({
                    url:url,
                    type:'post',
                    data:{
                        from_data_id:from_data_id
                    },
                    dataType:'json',
                    beforeSend:function () {
                        layer.load(2);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function (response) {
                        layer.closeAll('loading');
                        layer.msg(response.msg);
                        setTimeout(function () {
                            if(response.status=='s'){
                                window.location.href = response.url
                            }else{
                                layer.msg(response.msg);
                            }
                            layer.closeAll('loading');
                        },3000);
                    }
                });
            });
        });
    </script>
@endsection