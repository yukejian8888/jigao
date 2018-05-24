<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">
        <div class="box-header with-border">
        
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form">
                <div class="form-group">
                    {!! Form::label('fortitle','角色名',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('role_name', $role_name,['class'=>'form-control','placeholder'=>'角色名']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('role_status',['20' => '禁用', '10' => '启用'],$role_status) !!}
                        </div>
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','级别',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('role_level', $role_level,['class'=>'form-control','placeholder'=>'级别']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','备注',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('remarks', $remarks,['class'=>'form-control','placeholder'=>'备注']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>


            </div>
            <!-- /.box-body -->

    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
</div>
<!-- /.row -->
