@extends('partials.user.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            采集文章管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('u.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">采集文章管理</li>
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
                            <h5>采集文章列表</h5>
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-1">
                            <a href="{{route('user_article_collection.index')}}" class="btn btn-default btn-sm pull-right"><i class="fa fa-list "></i>&nbsp;查看</a>
                        </div>

                        {!! Form::open(['route' => ['user_article_collection.index'],'method' => 'get']) !!}
                        <div class="col-sm-3">
                            {!! Form::text('word', '',['class'=>'form-control pull-right input-sm','placeholder'=>'名称']) !!}
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
                            <th>标题</th>
                            <th>所属分类</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($infos as $item)
                            <tr class="dogo-remove-{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->sort_id}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{route('user_article_collection.show',['id'=>$item['id']])}}" title="查看"><i class="fa fa-edit"> </i>查看</a>&nbsp;
                                    <a href="{{route('user_article_collection.edit',['id'=>$item['id']])}}" title="编辑"><i class="fa fa-edit"> </i>编辑</a>&nbsp;
                                    <a href="javascript:void(0)" class="dogo-click-delete" title="删除" data-url="{{route('user_article_collection.destroy',['id'=>$item['id']])}}" data-title="{{$item->title}}" data-id="{{$item->id}}"><i class="fa fa-trash-o"> </i>删除</a>
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