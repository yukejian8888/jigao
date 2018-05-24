@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">考勤规则添加</li>
        </ol>
        考勤规则添加
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['attendance_setting.store'],'class'=>'form-horizontal']) !!}
    @include('admin.attendance_setting._form',['box_title'=>'考勤组添加','backurl'=>'attendance_setting.index','param'=>[]])
    {!! Form::close() !!}
    <!-- /.content -->
@endsection
@section('content_second')
    @include('admin.attendance_setting._form_select_user')
@endsection