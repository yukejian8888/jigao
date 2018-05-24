@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">添加知识库分类</li>
        </ol>
        添加知识库分类
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['knowledge_sort.store'],'class'=>'form-horizontal']) !!}
        @include('admin.knowledge_sort._form',['box_title'=>'知识库分类添加','backurl'=>'knowledge_sort.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection