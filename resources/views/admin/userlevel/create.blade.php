@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            会员等级管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加会员等级信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['userlevel.store'],'class'=>'form-horizontal']) !!}
        @include('admin.userlevel._form',['box_title'=>'会员等级信息添加','backurl'=>'userlevel.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection