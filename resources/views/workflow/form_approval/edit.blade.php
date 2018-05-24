@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">我的审批信息编辑</li>
        </ol>
        我的审批信息编辑
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['form_approval.update', $infos['id']],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('workflow.form_approval._form',['box_title'=>'我的审批信息编辑','backurl'=>'form_approval.index','param'=>[]])
    {!! Form::close() !!}
@endsection