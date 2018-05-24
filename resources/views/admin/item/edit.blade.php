@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">编辑项目信息</li>
        </ol>
        编辑项目信息
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['item.update', $id],'method' => 'put']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.item._form',['box_title'=>'项目信息编辑','backurl'=>'item.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection