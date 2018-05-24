@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            微信回复信息管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">微信回复信息信息管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['wechat_info.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.wechat_info._form',['box_title'=>'微信回复信息信息编辑','backurl'=>'wechat_info.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection