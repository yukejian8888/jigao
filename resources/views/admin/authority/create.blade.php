@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">组织架构添加</li>
        </ol>
        组织架构添加
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['authority.store'],'class'=>'form-horizontal']) !!}
    @include('admin.authority._form',['box_title'=>'权限添加','backurl'=>'authority.index','param'=>[]])
    {!! Form::close() !!}


    <!-- /.content -->
@endsection