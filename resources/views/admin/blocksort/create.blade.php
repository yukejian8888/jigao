@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            碎片分类管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加碎片分类信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['blocksort.store'],'class'=>'form-horizontal']) !!}
        @include('admin.blocksort._form',['box_title'=>'碎片分类信息添加','backurl'=>'blocksort.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection