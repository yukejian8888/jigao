@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">添加文章分类信息</li>
        </ol>
        添加文章分类信息
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['articlesort.store'],'class'=>'form-horizontal']) !!}
        @include('admin.articlesort._form',['box_title'=>'文章分类信息添加','backurl'=>'articlesort.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection