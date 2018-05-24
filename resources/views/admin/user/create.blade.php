@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">用户管理添加</li>
        </ol>
        用户管理添加
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['user.store'],'class'=>'form-horizontal']) !!}
    @include('admin.user._form',['box_title'=>'用户管理添加','backurl'=>'user.index','param'=>[]])
    {!! Form::close() !!}


    <!-- /.content -->
@endsection