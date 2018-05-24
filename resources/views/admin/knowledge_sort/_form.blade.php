<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!-- /.box-header -->
    <div class="box-body dogo-box-form">
        <div class="form-group">
            {!! Form::label('fortitle','分类名称',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('name', $name,['class'=>'form-control','placeholder'=>'分类名称']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('forcontent','关键词',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('keywords', $keywords,['class'=>'form-control','placeholder'=>'关键词']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('forcontent','描述',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::textarea('description', $description,['class'=>'form-control','rows'=>3,'placeholder'=>'描述']) !!}
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('forcontent','状态',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                <div class="radio">
                    {!! Form::multiradio('status',['20' => '启用', '10' => '禁用'],$status) !!}
                </div>
                <span class="help-block m-b-none"></span>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('fortitle','排序',['class'=>'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('order_by', $order_by,['class'=>'form-control','placeholder'=>'排序']) !!}

                <span class="help-block m-b-none"></span>
            </div>
        </div>

    </div>
    <!-- /.box-body -->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>


</div>
<!-- /.row -->
