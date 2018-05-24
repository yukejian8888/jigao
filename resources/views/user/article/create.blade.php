@extends('partials.user.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            文章管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('u.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加文章信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['user_article.store']]) !!}
        @include('user.article._form',['box_title'=>'文章信息添加','backurl'=>'user_article.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection