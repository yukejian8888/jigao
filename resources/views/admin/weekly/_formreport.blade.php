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
                    {!! Form::text('title', $title,['class'=>'form-control','placeholder'=>'周报名称','readonly']) !!}
                </div>

                <div class="table-responsive no-padding">
                    <table id="table-id" class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>项目名称</th>
                            <th>计划开始时间</th>
                            <th>计划完成时间</th>
                            <th width="240px;">备注</th>
                            <th>实际完成时间</th>
                            <th width="120px">完成情况</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($item as $data)
                            <tr>
                                <input type="hidden" name="project_id[]" value="{{$data['id']}}"/>
                                <td>{!! Form::text('project_name[]', $data['project_name'],['class'=>'form-control lay_time','readonly']) !!}</td>
                                <td>{!! Form::text('start_time[]', date('Y-m-d',$data['start_time']),['class'=>'form-control lay_time','readonly']) !!}</td>
                                <td>{!! Form::text('end_time[]', date('Y-m-d',$data['end_time']),['class'=>'form-control lay_time','readonly']) !!}</td>
                                <td>{!! Form::textarea('remark[]', $data['remark'],['class'=>'form-control lay_time','rows'=>'2','readonly']) !!}</td>
                                @if($data['actual_complete_time'] === null)
                                    <td>{!! Form::text('actual_complete_time[]', date('Y-m-d',time()),['class'=>'form-control lay_time3'.$data['id'],'yu'=>'lay_time3'.$data['id'],'onmouseover'=>"yulaydate(this)"]) !!}</td>
                                @else
                                    <td>{!! Form::text('actual_complete_time[]', date('Y-m-d',$data['actual_complete_time']),['class'=>'form-control lay_time3'.$data['id'],'yu'=>'lay_time3'.$data['id'],'onmouseover'=>"yulaydate(this)"]) !!}</td>
                                @endif
                                <td>
                                    {!! Form::select('complete_status[]',['10' => '未开始', '11' => '进行中', '20' => '已完成'],$data['complete_status'],['class'=>'form-control']) !!}

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    {!! Form::label('forplan_remark','计划备注') !!}
                    {!! Form::textarea('plan_remark', $plan_remark,['class'=>'form-control','placeholder'=>'计划备注','rows'=>'4','readonly']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('forcomplete_remark','完成备注') !!}
                    {!! Form::textarea('complete_remark', $complete_remark,['class'=>'form-control','placeholder'=>'完成备注','rows'=>'4']) !!}
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
    function yulaydate(s){
        var c = $(s).attr('yu');
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            laydate.render({
                elem: '.'+c//指定元素
            });
        });
    }
</script>


