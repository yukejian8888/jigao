<div class="row">
    <div class="col-md-9">
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('fortitle','标题') !!}
                    {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'标题']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','副标题') !!}
                    {!! Form::text('subtitle', $subtitle,['class'=>'form-control','placeholder'=>'副标题']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('forsortid','所属分类') !!}
                    <input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('sort_list_tree',['sort_name'=>'article_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','原文网址') !!}
                    {!! Form::text('source_url', $source_url,['class'=>'form-control','placeholder'=>'原文网址']) !!}
                    <div class="dogo-tip">尊重版权，请填写原文网址</div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','内容') !!}
                    {!! Form::textarea('content', $content,['id'=>'content','class'=>'form-control','style'=>'width:100%;height:400px;visibility:hidden;']) !!}
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
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-body">

                <div class="form-group">
                    {!! Form::label('forcontent','关键词') !!}
                    {!! Form::text('keywords', $keywords,['class'=>'form-control','placeholder'=>'关键词']) !!}
                    <span class="dogo-tip">优化搜索引擎关键词</span>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','简介') !!}
                    {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'内容简介']) !!}
                    <span class="dogo-tip">优化搜索引擎描述</span>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','发布状态') !!}
                    <div class="radio">
                        {!! Form::multiradio('status_publish',['20' => '发布', '10' => '存草稿'],$status_publish) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','标题图') !!}
                    {!! Form::text('pic', $pic,['class'=>'form-control','placeholder'=>'图片地址']) !!}
                    <br/>
                    <input type="file" lay-type="images" lay-ext="jpg|png|gif" name="file" class="layui-upload-file">
                </div>
                <div class="form-group">
                    @if(!empty($pic))
                        <img class="img-responsive dogo-upload-pic" style="display: block;max-width:200px;max-height: 200px;" src="{{$pic}}"/>
                    @else
                        <img class="img-responsive dogo-upload-pic" style="display: none;max-width:200px;max-height: 200px;" src="{{$pic}}"/>
                    @endif

                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<script>
    layui.use('layedit', function(){
        var layedit = layui.layedit;
        layedit.set({
            uploadImage: {
                url: '{{route("user.upload")}}', //接口url
                type: 'post' //默认post
            }
        });
        layedit.build('content'); //建立编辑器
    });

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
