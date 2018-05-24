@include('vendor.ueditor.assets')
<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">

    <input type="hidden" name="form_id" value="{{$infos['id']}}" />
        <div class="form-group" style="width: 800px;margin:0 auto">
                {{--{!! $infos['content']['template'] !!}--}}
                {!! $infos_form !!}
                <span class="help-block m-b-none">
                </span>
        </div>



    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
</div>


<!-- 实例化编辑器 -->

