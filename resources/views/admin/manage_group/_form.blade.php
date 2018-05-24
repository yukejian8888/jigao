<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form">
                {!! Form::hidden('status_system', $status_system) !!}
                <div class="form-group">
                    {!! Form::label('fortitle','名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'名称']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','标识符',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        @if($status_system=='11')
                            {!! Form::text('mark', $mark,['class'=>'form-control','placeholder'=>'标识符']) !!}
                        @else
                            {!! Form::text('mark', $mark,['class'=>'form-control','placeholder'=>'名称','disabled'=>'disabled']) !!}
                        @endif
                        <span class="dogo-tip">系统标识符禁止修改，如需修改请配合程序调整。</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','是否默认',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('status_default',['10' => '默认', '11' => '不默认'],$status_default,['class'=>'flat-red']) !!}
                        </div>
                        <span class="dogo-tip">设置为默认分组时，当用户创建时，没有指明是属于哪个分组时将分配属于默认分组。</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','备注',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                    {!! Form::textarea('remark', $remark,['class'=>'form-control','style'=>'width:100%;height:200px;']) !!}
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
        <!-- /.box -->
    </div>
    <!-- /.col -->

    <!-- /.col -->
</div>
<!-- /.row -->
<script>

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>
