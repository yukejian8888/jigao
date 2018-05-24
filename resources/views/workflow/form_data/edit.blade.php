@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">编辑审批单</li>
        </ol>
        编辑审批单
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['form_design.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('workflow.form_design._form',['box_title'=>'编辑审批单','backurl'=>'form_design.index','param'=>[]])
    {!! Form::close() !!}
@endsection