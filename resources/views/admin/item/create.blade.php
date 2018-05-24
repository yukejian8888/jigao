@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">添加项目</li>
        </ol>
        添加项目
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['item.store']]) !!}
        @include('admin.item._form',['box_title'=>'项目信息添加','backurl'=>'item.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection