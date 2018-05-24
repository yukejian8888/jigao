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
                    {!! Form::label('fortitle','图片标题',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'图片标题']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                {!! Form::hidden('filepath', $filepath,['class'=>'form-control','placeholder'=>'图片']) !!}
                {!! Form::hidden('id', $id,['class'=>'form-control','placeholder'=>'相册id']) !!}
                {!! Form::hidden('sort_id', $sort_id,['class'=>'form-control','placeholder'=>'相册分类id']) !!}
                <div class="form-group">
                    {!! Form::label('fortitle','上传图片',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <input type="file" lay-type="images" lay-ext="jpg|png|gif" name="file" class="layui-upload-file">
                    </div>
                </div>

                @if(!empty($filepath))
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: block;max-width:200px;max-height: 200px;" src="{{$filepath}}"/>
                        </div>
                    </div>
                @else
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: none;max-width:200px;max-height: 200px;" src="{{$filepath}}"/>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('forcontent','描述',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'描述']) !!}
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
<script>
    //图片上传时先创建一条数据，保存的数据是同时保存标题和描述，但图片已经上传成功，
    // 修改图片应当只修改标题和描述，不能在修改页面上传图片
    //需要实现上传图片时，检测目录是否存在，不存在需要创建目录,方便管理目录
    layui.use(['upload'], function(){
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
                    $('input[name="id"]').val(res.data.id);
                    $('input[name="filepath"]').val(res.data.filepath);
                    $('.dogo-upload-pic').attr('src',res.data.filepath);
                    $('.dogo-upload-pic').css({'display':'block'});
                }else {
                    layer.msg(res.msg);
                }
            }
        });
    });


</script>
