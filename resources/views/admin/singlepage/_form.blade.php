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
                    {!! Form::label('forsortid','所属分类') !!}
                    <input name="sort_id" class="form-control easyui-combotree combotree" data-options="url:'{{route('sort_list_tree',['sort_name'=>'singlepage_sort'])}}',required:true" value="{{$sort_id}}" style="width:100%;height: 34px;">
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
                    {!! Form::label('forcontent','描述') !!}
                    {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'文档描述']) !!}
                    <span class="dogo-tip">优化搜索引擎描述</span>
                </div>
                <div class="form-group">
                    {!! Form::label('forcontent','状态') !!}
                    <div class="radio">
                        {!! Form::multiradio('status',['20' => '启用', '10' => '禁用'],$status) !!}
                    </div>
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
                url: '{{route("admin.upload")}}', //接口url
                type: 'post' //默认post
            }
        });
        layedit.build('content'); //建立编辑器
    });
</script>
