@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            单页文档分类管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">单页文档分类管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['singlepage.update', $id],'method' => 'put']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.singlepage._form',['box_title'=>'单页文档信息编辑','backurl'=>'singlepage.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection