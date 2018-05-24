@extends('partials.user.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            采集文章管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('u.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">采集文章管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['user_article_collection.update', $id],'method' => 'put']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('user.article_collection._form',['box_title'=>'采集文章信息编辑','backurl'=>'user_article_collection.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection