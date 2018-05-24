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
                        <input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('sort_list_tree',['sort_name'=>'block_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">
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
                <div class="form-group">
                    {!! Form::label('fortitle','图片',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('pic', $pic,['class'=>'form-control','placeholder'=>'图片']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                    <div class="col-sm-2">
                        <input type="file" lay-type="images" lay-ext="jpg|png|gif" name="file" class="layui-upload-file">
                    </div>
                </div>

                @if(!empty($pic))
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: block;max-width:200px;max-height: 200px;" src="{{$pic}}"/>
                        </div>
                    </div>
                @else
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: none;max-width:200px;max-height: 200px;" src="{{$pic}}"/>
                        </div>
                    </div>
                @endif
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
                    {!! Form::label('forcontent','关键词',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('keywords', $keywords,['class'=>'form-control','placeholder'=>'关键词']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','描述',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'描述']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','排序',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('order_by', $order_by,['class'=>'form-control','placeholder'=>'排序']) !!}
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
            url: '{{route("admin.upload")}}',
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
