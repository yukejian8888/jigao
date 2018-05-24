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
                                <h5>文章详情</h5>
                            </div>
                            <div class="col-sm-10 text-right">
                                <a class="btn" onclick="history.go(-1)">返回上一级</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive dogo-padding-10">
                        <div class="">{{$infos['title']}}
                        【<a href="{{$infos['href']}}" target="_blank"><i class="fa fa-sign-out"> </i>原文</a>】
                        </div>
                        <div class="content">{!! $infos['content'] !!}</div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <script>
            $(function () {
                $('img').each(function () {
                    $(this).attr('src','http://www.meiwenjx.com'+$(this).attr('src'));
                    console.log($(this).attr('src'))
                });
            });
        </script>
    </section>
@endsection