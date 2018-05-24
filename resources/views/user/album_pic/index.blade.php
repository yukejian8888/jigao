@extends('partials.user.template')
@section('content')
    @include('partials.common.success')
    <section class="content-header">
        <h1>
            相册图片管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('user.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">相册图片管理</li>
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
                                <h5>相册图片列表</h5>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="{{route('u_album_pic.create',['sort_id'=>$sort_id])}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;上传图片</a>&nbsp;&nbsp;&nbsp;
                                <a href="{{route('u_album_sort.create')}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;新建文件夹</a>
                                <a href="{{route('u_album_sort.index')}}" class="btn btn-info btn-sm"><i class="fa fa-list"></i>&nbsp;返回相册</a>
                            </div>

                            {!! Form::open(['route' => ['u_album_pic.index'],'method' => 'get']) !!}
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


                    <div class="box-body dogo-padding-10">
                        <div class="row">
                            @foreach($infos_album_pic as $k=>$v)
                                <div class="col-md-2 dogo-remove-{{$v->id}}">
                                    <div class="box dogo-album-box box-warning ">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">{{$v['title']}}</h3>
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="编辑" data-widget="chat-pane-toggle">
                                                    <a href="{{route('u_album_pic.edit',['id'=>$v['id'],'sort_id'=>$v['sort_id']])}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </button>
                                                <button type="button" class="btn btn-box-tool dogo-click-delete" title="删除图片"  data-url="{{route('u_album_pic.destroy',['id'=>$v['id']])}}" data-title="{{$v->title}}" data-id="{{$v->id}}"><i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body">
                                                <div class="dogo-pic-fengmian">
                                                    {!! Html::image($v['filepath']) !!}
                                                </div>
                                            {{--<div class="dogo-num"></div>--}}
                                        </div>
                                        <!-- /.box-body -->

                                        <!-- /.box-footer-->
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                    <!-- /.box-body -->



                    <div class="box-footer clearfix">

                        {{ $infos_album_pic->appends(['word'=>$word,'sort_id'=>$sort_id])->links('partials.common.pagination') }}
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection