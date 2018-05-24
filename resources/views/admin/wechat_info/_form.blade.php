<div class="row">
    <!--  column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
            <!-- /.box-header -->
            <div class="box-body  dogo-box-form">
                <div class="form-group">
                    {!! Form::label('fortitle','关键词',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('keyword', $keyword,['class'=>'form-control','placeholder'=>'关键词']) !!}
                        <span class="dogo-tip">当用户输入关键词时，根据该关键词返回给用户信息</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','标题',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'标题']) !!}
                        <span class="dogo-tip"></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('fortitle','回复消息类型',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {{--回复消息类型，10文本消息，11图片消息，12语音消息，13视频消息，14音乐消息，15图文消息--}}
                            {!! Form::multiradio('type_reply_info',['10' => '文本消息', '15' => '图文消息'],$type_reply_info) !!}
                        </div>
                        <span class="dogo-tip">发送消息，被动回复消息,文本消息为单条消息，添加多条消息的话，数据查询最新的一条</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forkey','事件类型',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        <div class="radio">
                            {{--'事件类型，20普通事件（即没有事件），10关注事件，11取消关注事件，12上报地理位置事件，13自定义菜单点击事件，14自定义菜单链接事件'--}}
                            {!! Form::multiradio('type_event',['20' => '普通事件', '10' => '关注事件', '11' => '取消关注事件', '11' => '自定义菜单点击事件'],$type_event) !!}
                        </div>
                        <span class="dogo-tip">用户发送关键词等文本消息，请选择普通事件</span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('forkey','菜单事件列表',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::multicheckbox('type_event_key[]',$select_type_event_key,$type_event_key,['placeholder'=>'菜单事件列表']) !!}

                        <span class="dogo-tip">事件类型为自定义菜单事件时，该是必填，否则点击菜单时没有数据返回</span>
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
                    {!! Form::label('fortitle','图文消息跳转地址',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::text('url', $url,['class'=>'form-control','placeholder'=>'图文消息跳转地址']) !!}
                        <span class="dogo-tip">点击图文消息跳转链接,请使用http://开头的完整地址</span>
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
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('forcontent','默认消息',['class'=>'col-sm-2 control-label']) !!}--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<div class="radio">--}}
                            {{--{!! Form::multiradio('is_default',['10' => '否', '20' => '默认'],$is_default) !!}--}}
                        {{--</div>--}}
                        {{--<span class="dogo-tip">当查询数据为空时，回复默认消息</span>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="form-group">
                    {!! Form::label('fortitle','回复内容',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-9">
                        {!! Form::textarea('content', $content,['class'=>'form-control','rows'=>3,'placeholder'=>'内容']) !!}
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