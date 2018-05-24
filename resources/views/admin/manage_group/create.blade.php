@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
             用户组管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加 用户组信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['manage_group.store'],'class'=>'form-horizontal']) !!}
        @include('admin.manage_group._form',['box_title'=>' 用户组信息添加','backurl'=>'manage_group.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection