@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">知识库列表</li>
        </ol>
        知识库列表
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    <!-- Main content -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{route('knowledge.create')}}" class="btn btn-labeled btn-info"><span
                                class="btn-label"><i class="fa fa-plus"></i></span>添加</a>
                </div>
                <div class="col-md-6">
                    {!! Form::open(['route' => ['knowledge.index'],'method' => 'get','class'=>'form-inline']) !!}
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
                        <th>标题</th>
                        <th>所属分类</th>
                        <th>访问量</th>
                        <th>添加时间</th>
                        <th>状态</th>
                        <th width="140px">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($infos as $item)
                        <tr class="dogo-remove-{{$item->id}}">
                            <td>{{$item->id}}</td>
                            <td>{{$item->title}}</td>
                            <td>{{get_sort_name($item->sort_id,'knowledge')}}</td>
                            <td>{{$item->view}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{!! Html::radio(['20' => '启用', '10' => '禁用'],$item->status)!!}</td>
                            <td>
                                <a href="{{route('knowledge.edit',['id'=>$item['id']])}}" title="编辑"><i
                                            class="fa fa-edit"> </i> 编辑</a>&nbsp;
                                <a href="javascript:void(0)" class="dogo-click-delete" title="删除"
                                   data-url="{{route('knowledge.destroy',['id'=>$item['id']])}}"
                                   data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i> 删除</a>
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
@endsection