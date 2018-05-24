{!! Html::script('plugins/layui/layui.js') !!}
{!! Html::style('plugins/layui/css/layui.css') !!}
@include('vendor.ueditor.assets')
<div class="panel panel-default">
            <div class="panel-heading">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
        <div class="panel-body">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('fortitle','项目名称') !!}
                    {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'项目名称']) !!}
                </div>

               {{-- <div class="form-group">
                    {!! Form::label('forcontent','项目基本信息') !!}
                    --}}{{--{!! Form::textarea('information', $information,['id'=>'content','class'=>'form-control','style'=>'width:100%;height:400px;visibility:hidden;']) !!}--}}{{--
                    <script id="container" name="information" type="text/plain">{!! $information !!}</script>
                </div>--}}

                <div class="form-group">
                    {!! Form::label('forcontent','项目基本信息') !!}
                    {!! Form::textarea('information', $information,['class'=>'form-control','placeholder'=>'项目基本信息']) !!}
                </div>
            </div>
            <!-- /.box-body -->
        </div>
            <div class="panel-footer">
                {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
                <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
            </div>


        <!-- /.box -->
</div>
<!-- /.row -->

<script>
    layui.use('layedit', function(){
        var layedit = layui.layedit;
        layedit.set({
            uploadImage: {
                url: '{{route("admin.upload")}}', //接口url
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

<!-- 实例化编辑器 -->
<script type="text/javascript">
    var leipiEditor = UE.getEditor('container',{
        toolleipi:true,//是否在toolbars显示，表单设计器的图标
        toolbars:[[
            'fullscreen', 'source', '|', 'undo', 'redo', '|','bold', 'italic', 'underline', 'fontborder',
            'strikethrough',  'removeformat', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist',
            '|', 'fontfamily', 'fontsize', '|', 'indent', '|', 'justifyleft', 'justifycenter', 'justifyright',
            'justifyjustify', '|',  'link', 'unlink',  '|','simpleupload',  'horizontal',  'spechars',  'wordimage',
            '|', 'inserttable', 'deletetable',  'mergecells',  'splittocells', '|','template'
        ]],
        textarea: 'design_content',//编辑器的表单名称
        //默认的编辑区域高度
        initialFrameHeight:300

    });
</script>
