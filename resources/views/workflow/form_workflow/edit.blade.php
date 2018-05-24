@extends('partials.admin.template')
@section('content')
    <!-- Content Header (Page header) -->
    <h3>
        <!-- Breadcrumb right aligned-->
        <ol class="breadcrumb pull-right">
            <li><a href="{{route('admin.index')}}">首页</a></li>
            <li class="active">工作流程设置</li>
        </ol>
        【{{$infos_design['title']}}】工作流程设置
        <!-- Small text for title-->
        <span class="text-sm hidden-xs"></span>
    </h3>
    @include('partials.common.errors')
    <!-- content -->
    {!! Form::open(['route' => ['form_workflow.update', $infos_design['id']],'method' => 'put','class'=>'form-horizontal']) !!}
    {!! Form::hidden('_method','put') !!}
    @include('workflow.form_workflow._form',['box_title'=>'表单模板信息编辑','backurl'=>'form_design.index','param'=>[]])
    {!! Form::close() !!}

    <div class="dogo-js-item-tpl" style="display: none;">
        <div class="panel panel-green dogo-item-tpl-row" data-tpl-row="0">
            <input type="hidden" class="dogo-js-approval-grade" name="grade[]" value=""/>
            <div class="panel-heading portlet-handler">
                <span class="dogo-js-tpl-row-num">1</span>级审批
                <a href="javascript:void(0);"
                   class="pull-right dogo-color-black dogo-js-delete-tpl dogo-item-detele-tpl" data-tpl-row="">
                    <em class="fa fa-trash-o"></em>
                </a>
            </div>
            <div class="panel-body">
                <div class="">审批人员
                    <span class="dogo-flow-01">

                    </span>
                    <span class="btn btn-default btn-sm dogo-js-approval dogo-js-add-approval" data-tpl-row="0"><i
                                class="fa fa-plus"></i> </span></div>
                <div class="radio c-radio">
                    审批类型
                    <label>
                        <input class="dogo-js-approval-type" name="type_approval[0]" type="radio" checked="checked" value="10">
                        <span class="fa fa-check"></span>会签
                    </label>
                    <label>
                        <input class="dogo-js-approval-type" name="type_approval[0]" type="radio" value="11">
                        <span class="fa fa-check"></span>或签
                    </label>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content_second')
    @include('workflow.form_workflow._form_select')
@endsection