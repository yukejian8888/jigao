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
                    {!! Form::label('fortitle','网址',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-7">
                        {!! Form::text('url', $url,['class'=>'form-control','placeholder'=>'网址']) !!}
                        <span class="dogo-tip">完善网址后，点击右侧抓取按钮，将完善网页名称，关键词，描述（备注：首页请确保网页是否能正常打开，访问速度）</span>
                    </div>
                    <div class="col-sm-2">
                        <a href="javascript:void(0)" class="btn btn-default dogo-js-get-info">抓取网页数据</a>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forsortid','所属分类',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('u.sort_list_tree',['sort_name'=>'webpage_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','名称',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'名称']) !!}
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
                    {!! Form::label('forcontent','备注',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('remark', $remark,['class'=>'form-control','rows'=>3,'placeholder'=>'备注']) !!}
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

    $('.dogo-js-get-info').click(function () {
        var url = "{{route('u.get_webpage_info')}}";
        var url_str = $('input[name="url"]').val();
        if(url_str==''){
            layui.use(['layer'], function() {
                var layer = layui.layer;
                layer.msg('网页地址不能为空', {
                    icon: 2
                    ,shade: 0.01
                    ,time: 1*1000 //60s后自动消失
                });
            });
            return false;
        }
        $.ajax({
            url:url,
            type:'post',
            data:{
                url_str:url_str
            },
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function (response) {
                var msg = response.msg;
                console.log(response);
                if(response.status=='s'){
                    var res_info = response.info;
                    $('input[name="title"]').val(res_info.title);
                    $('input[name="keywords"]').val(res_info.keywords);
                    $('textarea[name="description"]').val(res_info.description);
                }else if(response.status=='f'){
                    layui.use(['layer'], function() {
                        var layer = layui.layer;
                        layer.msg(msg, {
                            icon: 2
                            ,shade: 0.01
                            ,time: 1*1000 //60s后自动消失
                        });
                    });//layui

                }

            }
        });//ajax
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
