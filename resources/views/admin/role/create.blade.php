@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">用户管理息添加</li>
        </ol>
        用户管理息添加
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['role.store'],'class'=>'form-horizontal']) !!}
    @include('admin.role._form',['box_title'=>'用户管理息添加','backurl'=>'role.index','param'=>[]])
    {!! Form::close() !!}


    <!-- /.content -->
@endsection