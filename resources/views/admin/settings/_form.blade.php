<div class="row">
    <!--  column -->
    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>''])
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <input type="hidden" name="gid" value="{{$gid}}">
                @foreach($infos as $k=>$v)
                    <div class="form-group">
                        @if($v['input_type']=='text')
                            {!! Form::label('fortitle',$v['name'],['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('value['.$v["id"].']', $v['config_value'],['class'=>'form-control','placeholder'=>'']) !!}
                                <span class="dogo-tip">【调用参数名：{{$v['config_name']}}】说明：{{$v['config_info']}}</span>
                            </div>
                        @elseif($v['input_type']=='textarea')
                            {!! Form::label('fortitle',$v['name'],['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::textarea('value['.$v["id"].']', $v['config_value'],['class'=>'form-control','placeholder'=>'','rows'=>4]) !!}
                                <span class="dogo-tip">【调用参数名：{{$v['config_name']}}】说明：{{$v['config_info']}}</span>
                            </div>
                        @elseif($v['input_type']=='radio')
                            {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                <div class="radio">
                                    {!! Form::multiradio('value['.$v["id"].']',json_decode((string)$v['config_value_list']),$v['config_value']) !!}
                                </div>
                                <span class="dogo-tip">【调用参数名：{{$v['config_name']}}】说明：{{$v['config_info']}}</span>
                            </div>

                        @elseif($v['input_type']=='select')
                            {!! Form::label('forsortid',$v['name'],['class'=>'col-sm-2 control-label']) !!}
                            <div class="col-sm-9">
                                {!! Form::select('value['.$v["id"].']',json_decode((string)$v['config_value_list']),$v['config_value'], ['class'=>'form-control']) !!}
                                <span class="dogo-tip">【调用参数名：{{$v['config_name']}}】说明：{{$v['config_info']}}</span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
            </div>


        </div>


    </div>
</div>
<!-- /.row -->
