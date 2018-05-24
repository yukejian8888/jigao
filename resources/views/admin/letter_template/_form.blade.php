<div class="row">
    <!--  column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body  dogo-box-form">
                <div class="form-group">
                    {!! Form::label('fortitle','名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'名称']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forkey','标识符',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('mark', $mark,['class'=>'form-control','placeholder'=>'标识符']) !!}
                        <span class="dogo-tip">注：标识符设定后，如需修改请配合程序进行修改。</span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forremark','模板',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('template', $template,['class'=>'form-control','rows'=>3,'placeholder'=>'模板']) !!}
                        <span class="dogo-tip">模板参数，用于站内信推送，用户名：{username}.示例：恭喜您：{username}，注册成功。</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forremark','备注',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('remark', $remark,['class'=>'form-control','rows'=>3,'placeholder'=>'备注']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('status',['20' => '启用', '10' => '禁用'],$status) !!}
                        </div>
                        <span class="dogo-tip">启用状态时，该参数设置方可生效。</span>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
                <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
            </div>

        </div>


    </div>
</div>
<!-- /.row -->
