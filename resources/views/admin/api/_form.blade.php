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
                    {!! Form::label('forkey','KEY',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('key', $key,['class'=>'form-control','placeholder'=>'api key']) !!}
                        <span class="dogo-tip">为空时将重新生成新的key</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forsecret','SECRET',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('secret', $secret,['class'=>'form-control','placeholder'=>'api secret']) !!}
                        <span class="dogo-tip">为空时将重新生成新的secret</span>
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
                        <span class="dogo-tip"></span>
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
