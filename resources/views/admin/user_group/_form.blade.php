<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default ">
                            <div class="box-header with-border">
                                <h3 class="box-title"><label><strong>角色分组：</strong></label></h3>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="display: block;">

                                <div class="form-group">
                                    {!! Form::label('fortitle','选择分组',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-9">
                                        <label>
                                            {!! Form::multiradio('group_id',$group_radio_list,$group_id,['class'=>'flat-red']) !!}
                                        </label>
                                        <span class="dogo-tip">禁用时不可访问该分组</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-9">
                                        <label>
                                            {!! Form::multiradio('status_auth',['20' => '启用', '10' => '禁用'],$status_auth,['class'=>'flat-red']) !!}
                                        </label>
                                        <span class="dogo-tip">禁用时表明不拥有该分组权限</span>
                                    </div>
                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>

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
</div>
<!-- /.row -->
<script>

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>