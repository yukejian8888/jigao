@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">权限管理</li>
        </ol>
        权限管理
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['authority.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('admin.authority._form',['box_title'=>'权限管理','backurl'=>'authority.index','param'=>[]])
    {!! Form::close() !!}
@endsection