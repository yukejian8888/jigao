<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form">

                <div class="form-group">
                    {!! Form::label('fortitle','名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                    {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'名称']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','排序',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                    {!! Form::number('order_by', $order_by,['class'=>'form-control','placeholder'=>'名称']) !!}
                        <span class="dogo-tip"></span>
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
