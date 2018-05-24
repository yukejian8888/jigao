<div class="row">
    <div class="col-md-6">
        {{$box_title}}
    </div>
    <div class="col-md-6">
        @if(!empty($backurl))
        <div class="input-group pull-right">
            <a href="{{route($backurl,$param)}}" class="btn btn-labeled btn-default"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>取消&返回</a>
        </div>
        @endif
    </div>
</div><!--row-->