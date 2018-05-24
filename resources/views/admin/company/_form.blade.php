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
                    {!! Form::label('fortitle','单位名',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('com_name', $com_name,['class'=>'form-control','placeholder'=>'单位名']) !!}
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','单位地址',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('com_address', $com_address,['class'=>'form-control','placeholder'=>'单位地址']) !!}
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','单位电话',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('com_telphone', $com_telphone,['class'=>'form-control','placeholder'=>'单位电话']) !!}
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','联系人名',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('contact', $contact,['class'=>'form-control','placeholder'=>'联系人名']) !!}
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','联系电话',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('contact_telphone', $contact_telphone,['class'=>'form-control','placeholder'=>'联系电话']) !!}
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('com_status',['10' => '启用', '20' => '禁用'],$com_status) !!}
                        </div>
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('own',['10' => '本单位', '11' => '非本单位'],$own) !!}
                        </div>
                       <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','单位简写',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('shorthand', $shorthand,['class'=>'form-control','placeholder'=>'单位简写']) !!}
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
