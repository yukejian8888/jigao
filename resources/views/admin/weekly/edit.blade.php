@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">编辑周报信息</li>
        </ol>
        编辑周报信息
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')

    <!-- Main content -->
    <section class="content">
        {{--<input type="hidden" name="id[]" value="$infos['id']" />--}}
        {!! Form::open(['route' => ['weekly.update', $id],'method' => 'put']) !!}
        {!! Form::hidden('_method','put') !!}
        @include('admin.weekly._form',['box_title'=>'周报信息编辑','backurl'=>'weekly.index','param'=>[]])
        {!! Form::close() !!}
    </section>
    <!-- /.content -->

@endsection