@include('vendor.ueditor.assets')
<div class="panel panel-default">
            <div class="panel-heading">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])

                <div class="asd"></div>
            </div>
        <div class="panel-body">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('fortitle','周报名称') !!}
                    {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'周报名称']) !!}
                </div>

                <div class="table-responsive no-padding">
                    <table id="table-id" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>项目名称</th>
                            <th>计划开始时间</th>
                            <th>计划完成时间</th>
                            <th width="360px;">备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item as $data)
                            <tr>
                                <input type="hidden" name="project_id[]" value="{{$data['id']}}"/>
                                <td><input type="checkbox" name="test" /></td>
                                <td>{!! Form::text('project_name[]', $data['project_name'],['class'=>'form-control lay_time']) !!}</td>
                                <td>{!! Form::text('start_time[]', date('Y-m-d',$data['start_time']),['class'=>'form-control lay_time1'.$data["id"],'yu'=>'lay_time1'.$data["id"],'onmouseover'=>"yulaydate(this)"]) !!}</td>
                                <td>{!! Form::text('end_time[]', date('Y-m-d',$data['end_time']),['class'=>'form-control lay_time2'.$data["id"],'yu'=>'lay_time2'.$data["id"],'onmouseover'=>"yulaydate(this)"]) !!}</td>
                                <td>{!! Form::textarea('remark[]', $data['remark'],['class'=>'form-control lay_time','rows'=>'2']) !!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table><br />
                    <button type="button" class="mb-sm btn btn-default yu-js-addrow">追加一行</button>
                    <button type="button" class="mb-sm btn btn-default yu-js-delrow">删除选中行</button>

                </div>

                <div class="form-group">
                    {!! Form::label('forplan_remark','计划备注') !!}
                    {!! Form::textarea('plan_remark', $plan_remark,['class'=>'form-control','placeholder'=>'计划备注','rows'=>'4']) !!}
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

    var i=0;
    $(document).ready(function(){

        //追加一行
        $(".yu-js-addrow").click(function(){
            var s = "lay_time_yu_"+i;
            var b = "lay_time_yuu_"+i;
            var html = '<tr><input type="hidden" name="project_id[]" value=""/><td><input type="checkbox" name="test" /></td><td><input class="form-control " name="project_name[]" type="textarea" value=""></td><td><input class="form-control '+s+'"  yu="'+s+'"onmouseover="yulaydate(this)" name="start_time[]" type="text" value=""></td><td><input class="form-control '+b+'" yu="'+b+'" name="end_time[]" onmouseover="yulaydate(this)" type="text" value=""></td><td><textarea name="remark[]" class="form-control" cols="3"></textarea></td></tr>';
            $("tbody").append(html);
            i++;
        });

        //删除选中行
        $(".yu-js-delrow").click(function(){
            $("input[name='test']:checked").each(function(){
                $(this).parent().parent().remove();
            })
        })
    })

</script>
<script>
function yulaydate(s){
    var c = $(s).attr('yu');
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        laydate.render({
            elem: '.'+c//指定元素
            //,trigger: 'click' //采用click弹出
        });
    });
}
</script>

