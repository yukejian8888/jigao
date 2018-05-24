@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            站点参数设置
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">系统参数设置</li>
        </ol>
    </section>
    @include('partials.common.success')
    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['settings.update','0'],'method' => 'put','class'=>'form-horizontal']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.settings._form',['box_title'=>'参数设置','backurl'=>'settings.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection