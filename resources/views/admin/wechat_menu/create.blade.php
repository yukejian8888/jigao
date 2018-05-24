@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            添加微信菜单
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加微信菜单</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['wechat_menu.store'],'class'=>'form-horizontal']) !!}
        @include('admin.wechat_menu._form',['box_title'=>'添加微信菜单','backurl'=>'wechat_menu.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection