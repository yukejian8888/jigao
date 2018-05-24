<div class="row">
    <!--  column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form">
                <div class="form-group">
                    {!! Form::label('fortitle','相册名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'相册名称']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','相册描述',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'相册描述']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
                <a href="{{route($backurl)}}" class="btn btn-default">取消&返回</a>
            </div>

        </div>


    </div>
</div>
<!-- /.row -->
