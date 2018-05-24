@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            会员分组管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">会员分组管理</li>
        </ol>
    </section>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['user_group.update', $id],'method' => 'put','class'=>'form-horizontal']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.user_group._form',['box_title'=>'会员分组信息编辑','backurl'=>'user.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection