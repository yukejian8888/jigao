@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            友情链接管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加友情链接信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['links.store'],'class'=>'form-horizontal']) !!}
        @include('admin.links._form',['box_title'=>'友情链接信息添加','backurl'=>'links.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection