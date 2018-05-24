@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            品牌管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加品牌信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['brand.store']]) !!}
        @include('admin.brand._form',['box_title'=>'品牌信息添加','backurl'=>'brand.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection