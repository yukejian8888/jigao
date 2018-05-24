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
                    {!! Form::label('fortitle','分类名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'分类名称']) !!}
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
