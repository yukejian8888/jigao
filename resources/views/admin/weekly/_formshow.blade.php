@include('vendor.ueditor.assets')
{!! Html::script('plugins/jquery/jquery.print.js') !!}
<div class="panel panel-default">
            <div class="panel-heading">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])

                <div class="asd"></div>
            </div>
        <div class="panel-body print-container">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label('fortitle','周报名称') !!}
                    <text class="form-control">{{$title}}</text>
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
                                <td>{{$data['project_name']}}</td>
                                <td>{{date('Y-m-d',$data['start_time'])}}</td>
                                <td>{{date('Y-m-d',$data['end_time'])}}</td>
                                <td>{{$data['remark']}}</td>
                                <td>{{date('Y-m-d',$data['actual_complete_time'])}}</td>
                                <td>{!! Html::radio(['10' => '未开始', '11' => '进行中','20' => '已完成'],$data['complete_status'])!!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    {!! Form::label('forplan_remark','计划备注') !!}
                    <text class="form-control">{{$plan_remark}}</text>
                </div>
                <div class="form-group">
                    {!! Form::label('forcomplete_remark','完成备注') !!}
                    <text class="form-control">{{$complete_remark}}</text>
                </div>

            </div>
            <!-- /.box-body -->
        </div>
        <div class="panel-footer">
            <button class="btn btn-info btn-js-print">打印</button>
        </div>

        <!-- /.box -->
</div>

<!-- /.row -->
<script>
    $(document).ready(function(){
        //打印
        $(".btn-js-print").click(function(){
            //输出内容
            $(".print-container").print({
                addGlobalStyles : true,
                stylesheet : null,
                rejectWindow : true,
                noPrintSelector : ".no-print",
                iframe : true,
                append : null,
                prepend : null
            });
        })
    })

</script>


