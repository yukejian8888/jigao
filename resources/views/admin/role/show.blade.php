@extends('partials.admin.template')
@section('content')
    @include('partials.common.success')
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">权限管理</li>
        </ol>
        权限管理
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    <!-- Main content -->

    <div class="panel panel-default">
        <!--panel-heading-->
        <div class="panel-body">
            <div class="table-responsive no-padding">
                {!! Form::open(['route' => 'role.authority','method' => 'post','class'=>'form-horizontal']) !!}
                {!! Form::hidden('_method','post') !!}
                {!! Form::hidden('id',$id) !!}
                @include('admin.role._authority_form',['box_title'=>$name.'--权限设置','backurl'=>'role.index','param'=>[]])
                {!! Form::close() !!}
            </div>
            <!--/--table-responsive-->
        </div>
        <!--/--panel-body-->
    </div>
@endsection