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
                @if( !empty($name))
                    <div class="form-group">
                        <label for="fortitle" class="col-sm-2 control-label">用户名</label>
                        <div class="col-sm-9">
                            <span class="form-control">{{$name}}</span>
                        </div>
                        {!! Form::hidden('name',$name) !!}
                    </div>
                @else
                    <div class="form-group">
                        {!! Form::label('fortitle','用户名',['class'=>'col-sm-2 control-label']) !!}
                        <div class="col-sm-9">
                                {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'用户名']) !!}
                            <span class="help-block m-b-none"></span>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    {!! Form::label('forcontent','用户角色',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {{--{!! Form::select('role_id',$role,$role_id,['class'=>'form-control']) !!}--}}
                        @foreach($role as $item)
                        {!! Form::checkbox('role_id[]',$item['id'] ,$item['checked'],['id'=>'role'.$item['id']],['id'=>'role'.$item['id']]) !!}
                        {!! Form::label('role'.$item['id'],$item['role_name']) !!}
                        @endforeach
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','密码',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::password('password',['class'=>'form-control','placeholder'=>'密码']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','注册邮箱',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('email', $email,['class'=>'form-control','placeholder'=>'邮箱']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','公司',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('com_id',$company,$com_id,['class'=>'form-control']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','部门',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('department', $department,['class'=>'form-control','placeholder'=>'部门']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','电话',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('phone', $phone,['class'=>'form-control','placeholder'=>'电话']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('fortitle','家庭住址',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('homeaddress', $homeaddress,['class'=>'form-control','placeholder'=>'电话']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','用户状态',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::select('status',['20' => '启用', '10' => '禁用'],$status,['class'=>'form-control']) !!}
                        <span class="help-block m-b-none"></span>
                    </div>
                </div>



                <div class="form-group">
                    {!! Form::label('forcontent','备注',['class'=>'col-sm-2 control-label']) !!}
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
