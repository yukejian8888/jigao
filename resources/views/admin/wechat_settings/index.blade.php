@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            微信配置管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">微信配置管理</li>
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
                            <h5>微信配置列表</h5>
                        </div>
                        <div class="col-sm-10 text-right">
{{--                            <a href="{{route('wechat_settings.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;添加</a>--}}
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>微信名称</th>
                            <th>微信号</th>
                            <th>APP ID</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach($infos as $item)
                            <tr class="dogo-remove-{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->number}}</td>
                                <td>{{$item->app_id}}</td>
                                <td>{!! Html::radio(['20' => '启用', '10' => '禁用'],$item->status)!!}</td>
                                <td>
                                    <a href="{{route('wechat_settings.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i> 编辑</a>&nbsp;
{{--                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('wechat_settings.destroy',['id'=>$item['id']])}}" data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i></a>--}}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.box-body -->



                <div class="box-footer clearfix">

                    {{ $infos->links('partials.common.pagination') }}
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    </section>
@endsection