@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">考勤规则编辑</li>
        </ol>
        考勤规则编辑
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['attendance_setting.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('admin.attendance_setting._form',['box_title'=>'考勤规则编辑','backurl'=>'attendance_setting.index','param'=>[]])
    {!! Form::close() !!}
@endsection
@section('content_second')
    @include('admin.attendance_setting._form_select_user')
@endsection