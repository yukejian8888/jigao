@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">角色管理</li>
        </ol>
        角色管理
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('role.create')}}" class="btn btn-labeled btn-info"><span class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['role.index'],'method' => 'get','class'=>'form-inline']) !!}
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
                        <th width="240px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $item)
                        <tr class="dogo-remove-{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->role_name}}</td>
                            <td>{!! Html::radio(['20' => '禁用', '10' => '启用'],$item->role_status)!!}</td>
                            <td>
                                <div class="dogo-text-links">
                                    <a href="{{route('role.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                    <a href="{{route('role.show',['id'=>$item['id']])}}" title="设置权限"><i class="fa icon-share"> </i> 设置权限</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('role.destroy',['id'=>$item['id']])}}" data-title="{{$item->role_name}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
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
@endsection