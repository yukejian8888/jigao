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
                    {!! Form::label('fortitle','部门名',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'部门名']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('status',['20' => '禁用', '10' => '启用'],$status) !!}
                        </div>
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>
               
                <div class="form-group">
                    {!! Form::label('forcontent','隶属',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('pid',$organization,$pid,['class'=>'form-control']) !!}
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
