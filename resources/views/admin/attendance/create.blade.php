@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">表单模板信息添加</li>
        </ol>
        表单模板信息添加
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['form_design.store'],'class'=>'form-horizontal']) !!}
    @include('admin.form_design._form',['box_title'=>'表单模板信息添加','backurl'=>'form_design.index','param'=>[]])
    {!! Form::close() !!}


    <!-- /.content -->
@endsection