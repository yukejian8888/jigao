@extends('partials.admin.template')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/Kindeditor/themes/default/default.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('/bower_components/Kindeditor/themes/simple/simple.css')}}"/>
    <script type="text/javascript" src="{{asset('/bower_components/Kindeditor/kindeditor-all-min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/bower_components/Kindeditor/lang/zh-CN.js')}}"></script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            广告分类管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">信息管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['adsort.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.adsort._form',['box_title'=>'广告分类信息编辑','backurl'=>'adsort.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection