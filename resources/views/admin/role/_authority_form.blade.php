
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">
        <div class="box-header with-border">
        
        </div>
        <!-- /.box-header -->
        <div class="box-body dogo-box-form">
            <ul >
                @foreach($authority as $item)
                    @if($item['pid'] == 0)
                        <li style="width:100%;" >
                            {!! Form::checkbox('role_authority[]',$item['id'] ,$item['checked'],['id'=>'authority'.$item['id']]) !!}
                            {!! Form::label('authority'.$item['id'],$item['name']) !!}
                            <ul style="margin-left: 20px;">
                                @foreach($authority as $sitem)
                                    @if($sitem['pid'] == $item['id'])
                                        <li style="float:left;">
                                            {!! Form::checkbox('role_authority[]',$sitem['id'] ,$sitem['checked'],['id'=>'authority'.$sitem['id']],$roleauthority) !!}
                                            {!! Form::label('authority'.$sitem['id'],$sitem['name']) !!}
                                        </li>
                                    @endif
                                @endforeach
                                <li style="clear:both;"></li>
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>
    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
<!-- /.row -->
