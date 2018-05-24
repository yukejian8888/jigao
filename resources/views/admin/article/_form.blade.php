{!! Html::script('plugins/layui/layui.js') !!}
{!! Html::style('plugins/layui/css/layui.css') !!}
@include('vendor.ueditor.assets')
{!! Html::script('vendor/ueditor/Formdesign/leipi.Formdesign.v4.js') !!}
<div class="panel panel-default">
<div class="row">
    <div class="col-md-9">
            <div class="panel-heading">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
            </div>
        <div class="panel-body">
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
                    {{--<input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('sort_list_tree',['sort_name'=>'article_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">--}}
                    {!! Form::select('sort_id',$article,$sort_id,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','内容') !!}
                    {{--{!! Form::textarea('content', $content,['id'=>'content','class'=>'form-control','style'=>'width:100%;height:400px;visibility:hidden;']) !!}--}}
                    <script id="container" name="content" type="text/plain">{!! $content !!}</script>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-body" style="margin: 60px 15px">
                <div class="form-group">
                    {!! Form::label('forcontent','关键词') !!}
                    {!! Form::text('keywords', $keywords,['class'=>'form-control','placeholder'=>'关键词']) !!}
                    <span class="help-block m-b-none">优化搜索引擎关键词</span>
                </div>

                <div class="form-group">
                    {!! Form::label('forcontent','描述') !!}
                    {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'文档描述']) !!}
                    <span class="help-block m-b-none">优化搜索引擎描述</span>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','属性') !!}
                    <div class="checkbox">
                        {!! Form::multicheckbox('flag[]',['t' => '推荐', 'z' => '置顶', 'r' => '热门'],$flag,['placeholder'=>'title']) !!}
                    </div>
                    <span class="help-block m-b-none">信息提示说明</span>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','状态') !!}
                    <div class="radio">
                        {!! Form::multiradio('status',['20' => '启用', '10' => '禁用'],$status) !!}
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
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
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
    leipiEditor.ready(function() {
        leipiEditor.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });


    var leipiFormDesign = {
        exec : function (method) {
            leipiEditor.execCommand(method);
        },
        fnCheckForm : function ( type ) {
            if(leipiEditor.queryCommandState( 'source' ))
                leipiEditor.execCommand('source');//切换到编辑模式才提交，否则有bug


            if(leipiEditor.hasContents()){
                leipiEditor.sync();       //同步内容

                var type_value,formid,formeditor;
                if( typeof type!=='undefined' ){
                    type_value = type;
                }
                formeditor=leipiEditor.getContent();

                $("#button_save").text("submit...");

                //异步提交数据
                $.ajax({
                    type: 'POST',
                    url : '{{route("form_design.create")}}',
                    dataType : 'json',
                    data : {
                        form_id:"",
                        design_content:formeditor
                    },
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    success : function(data){
                        $("#button_save").text("确定保存");
                        if(data.status==1){
                            alert('保存成功');
                            location.reload();
                        }else{
                            alert(data.info);
                        }
                    }
                });
            } else {
                alert('表单内容不能为空！');
                $('#submitbtn').button('reset');
                return false;
            }
        } ,

        fnReview : function (){
            if(leipiEditor.queryCommandState( 'source' ))
                leipiEditor.execCommand('source');//切换到编辑模式才提交，否则有bug

            if(leipiEditor.hasContents()){
                leipiEditor.sync();       //同步内容

                document.saveform.target="mywin";
                window.open('','mywin',"menubar=0,toolbar=0,status=0,resizable=1,left=0,top=0,scrollbars=1,width=" +(screen.availWidth-10) + ",height=" + (screen.availHeight-50) + "\"");
                document.saveform.action="/demo/temp_preview.html";
                document.saveform.submit(); //提交表单
            } else {
                alert('表单内容不能为空！');
                return false;
            }
        }
    };

</script>
