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
                    {!! Form::label('fortitle','名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'名称']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forsortid','所属分类',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('u.sort_list_tree',['sort_name'=>'account_password_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">
                        <span class="dogo-tip"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','备用字段1',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('field1', $field1,['class'=>'form-control','placeholder'=>'备用字段1']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','备用字段2',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('field2', $field2,['class'=>'form-control','placeholder'=>'备用字段2']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','备用字段3',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('field3', $field3,['class'=>'form-control','placeholder'=>'备用字段3']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','备用字段4',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('field4', $field1,['class'=>'form-control','placeholder'=>'备用字段4']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','备用字段5',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('field5', $field1,['class'=>'form-control','placeholder'=>'备用字段5']) !!}
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
                <div class="form-group">
                    {!! Form::label('forcontent','备注',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('remark', $remark,['class'=>'form-control','rows'=>3,'placeholder'=>'备注']) !!}
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
<script>
    layui.use(['upload','layer'], function(){
        var upload = layui.upload;
        var layer = layui.layer;
        upload({
            elem:'.layui-upload-file',
            url: '{{route("user.upload")}}',
            ext: 'jpg|png|gif',
            method:'post',
            before: function(input){
                //返回的参数item，即为当前的input DOM对象
//                console.log('文件上传中');
                layer.msg('文件上传中', {
                    icon: 16
                    ,shade: 0.01
                    ,time: 60*1000 //60s后自动消失
                });
            },
            success: function(res){
                layer.closeAll();
                console.log(res); //上传成功返回值，必须为json格式
                if(res.status=='s'){
                    //上传成功
                    $('input[name="pic"]').val(res.data.filepath);
                    $('.dogo-upload-pic').attr('src',res.data.filepath);
                    $('.dogo-upload-pic').css({'display':'block'});
                }else {
                    layer.msg(res.msg);
                }
            }
        });
    });


</script>
