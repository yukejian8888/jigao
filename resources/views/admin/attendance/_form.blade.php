@include('vendor.ueditor.assets')
{!! Html::script('vendor/ueditor/Formdesign/leipi.Formdesign.v4.js') !!}
<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('fortitle','表单标题',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('now_time', $title,['class'=>'form-control','placeholder'=>'表单标题']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('fortitle','所属分类',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('sort_id', 1,['class'=>'form-control','placeholder'=>'所属分类']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>

        <div class="form-group">

            {!! Form::label('fortitle','表单内容',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <span class="help-block m-b-none">
                    <strong>提醒：</strong>单选框和复选框，如：<code>{|-</code>选项<code>-|}</code>两边边界是防止误删除控件，程序会把它们替换为空，请不要手动删除！
                </span>
                {{--<textarea id="container" name="content_design"  type="text/plain">
                    {!! $content_design !!}
                </textarea>--}}
                <script id="container" name="content_design" type="text/plain">{!! $content_design !!}</script>
                <span class="help-block m-b-none">
                </span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::multiradio('status_check',['20' => '启用', '10' => '禁用'],$status_check) !!}
                </div>
                <span class="dogo-tip"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forcontent','是否上传附件',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::multiradio('status_file',['10' => '不需要', '20' => '需要'],$status_file) !!}
                </div>
                <span class="dogo-tip"></span>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('forcontent','备注',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('remark', $remark,['class'=>'form-control','rows'=>3,'placeholder'=>'备注']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
</div>


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
