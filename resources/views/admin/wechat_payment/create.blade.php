@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            微信支付配置管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加微信支付配置信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">

        {!! Form::open(['route' => ['wechat_payment.store'],'class'=>'form-horizontal']) !!}
        @include('admin.wechat_payment._form',['box_title'=>'微信支付配置信息添加','backurl'=>'wechat_payment.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection