@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            相册图片管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加相册图片信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['album_pic.store'],'class'=>'form-horizontal']) !!}
        @include('admin.album_pic._form_create',['box_title'=>'相册图片信息添加','backurl'=>'album_pic.index'])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection