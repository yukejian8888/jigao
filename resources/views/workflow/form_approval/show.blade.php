@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">审批记录</li>
        </ol>
        审批记录
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->

    @include('workflow.form_approval._show_info',['box_title'=>'审批记录','backurl'=>'form_approval.index','param'=>[]])
    @include('workflow.form_approval._show_log',['box_title'=>'','backurl'=>'form_approval.index','param'=>[]])
@endsection