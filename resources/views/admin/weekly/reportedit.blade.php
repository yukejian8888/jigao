@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">编辑上报周报信息</li>
        </ol>
        编辑上报周报信息
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {!! Form::open(['route' => ['weekly.update_report', $id],'method' => 'get']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.weekly._formreport',['box_title'=>'上报周报信息编辑','backurl'=>'weekly.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection