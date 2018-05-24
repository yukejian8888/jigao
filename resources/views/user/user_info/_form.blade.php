<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.user._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body dogo-box-form">

                <div class="form-group">
                    {!! Form::label('fortitle','头像',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('avatar', $avatar,['class'=>'form-control','placeholder'=>'图片']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                    <div class="col-sm-2">
                        <input type="file" lay-title="上传头像" lay-type="images" lay-ext="jpg|png|gif" name="file" class="layui-upload-file">
                    </div>
                </div>

                @if(!empty($avatar))
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: block;max-width:100px;max-height: 100px;" src="{{$avatar}}"/>
                        </div>
                    </div>
                @else
                    <div class="form-group" style="">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-7">
                            <img class="img-responsive dogo-upload-pic" style="display: none;max-width:100px;max-height: 100px;" src="{{$avatar}}"/>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    {!! Form::label('forcontent','性别',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {!! Form::multiradio('sex',['10' => '男', '11' => '女', '12' => '保密'],$sex) !!}
                        </div>
                        <span class="dogo-tip"></span>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','签名',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('signature', $signature,['class'=>'form-control','style'=>'width:100%;height:200px;']) !!}
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
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
<script>
    layui.use(['upload'], function(){
        var upload = layui.upload;
        upload({
            elem:'.layui-upload-file',
            url: '{{route("user.upload")}}',
            ext: 'jpg|png|gif',
            method:'post',
            success: function(res){
                console.log(res); //上传成功返回值，必须为json格式
                if(res.status=='s'){
                    //上传成功
                    $('input[name="avatar"]').val(res.data.filepath);
                    $('.dogo-upload-pic').attr('src',res.data.filepath);
                    $('.dogo-upload-pic').css({'display':'block'});
                }else {
                    layer.msg(res.msg);
                }
            }
        });
    });
</script>