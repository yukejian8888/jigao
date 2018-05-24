@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            碎片管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加碎片信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['block.store'],'class'=>'form-horizontal']) !!}
        @include('admin.block._form',['box_title'=>'碎片信息添加','backurl'=>'block.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection