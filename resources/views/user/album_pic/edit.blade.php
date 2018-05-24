@extends('partials.user.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            相册图片管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('u.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">相册图片管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['u_album_pic.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('user.album_pic._form_edit',['box_title'=>'相册图片信息编辑','backurl'=>'u_album_pic.index','param'=>['sort_id'=>$sort_id]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection