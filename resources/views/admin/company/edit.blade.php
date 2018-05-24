@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">单位管理编辑</li>
        </ol>
        单位管理编辑
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['company.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('admin.company._form',['box_title'=>'单位管理编辑','backurl'=>'company.index','param'=>[]])
    {!! Form::close() !!}
@endsection