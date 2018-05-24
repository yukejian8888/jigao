@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            站内信模板管理
            <small>Optional description</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.index')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">添加站内信模板信息</li>
        </ol>
    </section>

    @include('partials.common.errors')
    <!-- Main content -->
    <section class="content">

        {!! Form::open(['route' => ['letter_template.store'],'class'=>'form-horizontal']) !!}
        @include('admin.letter_template._form',['box_title'=>'站内信模板信息添加','backurl'=>'letter_template.index','param'=>[]])
        {!! Form::close() !!}


    </section>
    <!-- /.content -->

@endsection