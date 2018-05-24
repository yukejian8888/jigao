@extends('partials.admin.template')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/Kindeditor/themes/default/default.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/Kindeditor/themes/simple/simple.css')}}"/>
    <script type="text/javascript" src="{{asset('/bower_components/Kindeditor/kindeditor-all-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/bower_components/Kindeditor/lang/zh-CN.js')}}"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            友情链接分类管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加友情链接分类信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">

        {!! Form::open(['route' => ['linkssort.store'],'class'=>'form-horizontal']) !!}
        @include('admin.linkssort._form',['box_title'=>'友情链接分类信息添加','backurl'=>'linkssort.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection