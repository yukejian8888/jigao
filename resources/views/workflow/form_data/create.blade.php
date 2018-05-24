@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">增加审批单</li>
        </ol>
        增加审批单
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>

    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['form_data.store'],'class'=>'form-horizontal']) !!}
    @include('workflow.form_data._form',['box_title'=>'增加审批单','backurl'=>'form_data.index','param'=>[]])
    {!! Form::close() !!}


    <!-- /.content -->
@endsection