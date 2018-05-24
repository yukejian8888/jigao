<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-labeled btn-info dogo-js-add">
                    <span class="btn-label"><i class="fa fa-plus"></i></span>新增审批环节
                </a>
            </div>
            <div class="col-md-6">
                <div class="input-group pull-right">
                    <a href="{{route('form_design.index')}}" class="btn btn-labeled btn-default"><span class="btn-label"><i class="fa fa-rotate-left"></i></span>取消&返回</a>
                </div>
            </div>
        </div><!--row-->
    </div>
    <!--panel-heading-->
    <div class="panel-body">
        <div class="dogo-js-item-content">
            @foreach($infos_rule as $k=>$v)
                <div class="panel panel-green dogo-item-tpl-row dogo-js-item-tpl-{{$k+1}}" data-tpl-row="{{$k+1}}">
                    <input type="hidden" class="dogo-js-approval-grade" name="grade[]" value=""/>
                    <div class="panel-heading portlet-handler">
                        <span class="dogo-js-tpl-row-num">{{$k+1}}</span>级审批
                        <a href="javascript:void(0);"
                           class="pull-right dogo-color-black dogo-js-delete-tpl dogo-item-detele-tpl" data-tpl-row="{{$k+1}}">
                            <em class="fa fa-trash-o"></em>
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="">审批人员
                            <span class="dogo-flow-01 dogo-flow-row-id-{{$k+1}}">
                                @if($v['user_id'])
                                    @php($infos_user_list = get_user_list_by_user_id_in_array(json_decode($v['user_id'],true)))
                                    @foreach($infos_user_list as $m=>$n)
                                        <span class="dogo-warp-approval dogo-js-del-user-id-{{$n['id']}}">
                                            <input type="hidden" name="user_id[{{$k+1}}][]" value="{{$n['id']}}"/>
                                            <span class="dogo-border">{{$n['name']}}</span>
                                            <i class="fa icon-close dogo-font-close dogo-js-del-approval" data-user-id="{{$n['id']}}"></i>
                                        </span>
                                    @endforeach
                                @endif
                            </span>
                            <span class="btn btn-default btn-sm dogo-js-approval dogo-js-add-approval" data-tpl-row="{{$k+1}}"><i class="fa fa-plus"></i> </span>
                        </div>
                        <div class="radio c-radio">
                            审批类型
                            @if($v['type_approval'] == '10')
                                <label>
                                    <input class="dogo-js-approval-type" name="type_approval[{{$k+1}}]" type="radio" checked value="10">
                                    <span class="fa fa-check"></span>会签
                                </label>
                                <label>
                                    <input class="dogo-js-approval-type" name="type_approval[{{$k+1}}]" type="radio"  value="11">
                                    <span class="fa fa-check"></span>或签
                                </label>
                            @else
                                <label>
                                    <input class="dogo-js-approval-type" name="type_approval[{{$k+1}}]" type="radio" value="10">
                                    <span class="fa fa-check"></span>会签
                                </label>
                                <label>
                                    <input class="dogo-js-approval-type" name="type_approval[{{$k+1}}]" type="radio" checked value="11">
                                    <span class="fa fa-check"></span>或签
                                </label>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div><!--dogo-js-item-content-->
    </div>
    <!--/--panel-body-->
    <div class="panel-footer">
        {!! Form::submit('提交',['class'=>'btn btn-info']) !!}
        <a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>
    </div>
</div>


<script>
    $(function () {
        $('.dogo-js-add').click(function () {
            //获取最后一个row的值
            var tpl_row = parseInt($('.dogo-js-item-content .dogo-item-tpl-row:last').attr('data-tpl-row'));
//            alert(isNaN(image_row));
            if (isNaN(tpl_row)) {
                tpl_row = 1;
            } else {
                //此处两行代码请注意顺序
                $('.dogo-js-item-tpl .dogo-item-tpl-row').removeClass('dogo-js-item-tpl-' + parseInt(tpl_row));
                $('.dogo-js-item-tpl .dogo-flow-01').removeClass('dogo-flow-row-id-' + parseInt(tpl_row));
                tpl_row += 1;
            }
            //更新模板中的值
            $('.dogo-js-item-tpl .dogo-js-tpl-row-num').text(tpl_row);
            $('.dogo-js-item-tpl .dogo-item-tpl-row').attr('data-tpl-row', tpl_row);
            $('.dogo-js-item-tpl .dogo-js-approval').attr('data-tpl-row', tpl_row);
            $('.dogo-js-item-tpl .dogo-item-tpl-row').addClass('dogo-js-item-tpl-' + tpl_row);
            $('.dogo-js-item-tpl .dogo-item-input-tpl').addClass('dogo-js-item-input-tpl-' + tpl_row);
            $('.dogo-js-item-tpl .dogo-js-approval-input').addClass('dogo-js-approval-input-row-' + tpl_row);
            $('.dogo-js-item-tpl .dogo-flow-01').addClass('dogo-flow-row-id-' + tpl_row);
            $('.dogo-js-item-tpl .dogo-item-detele-tpl').attr('data-tpl-row', tpl_row);
            $('.dogo-js-item-tpl .dogo-js-approval-type').attr('name', 'type_approval['+tpl_row+']');
            $('.dogo-js-item-tpl .dogo-js-approval-grade').attr('name', 'grade['+tpl_row+']');
            var html = $('.dogo-js-item-tpl').html();
            $('.dogo-js-item-content').append(html);
            $('.dogo-js-item-tpl .dogo-flow-01').removeClass('dogo-flow-row-id-' + parseInt(tpl_row));
        });

        //删除任意html元素
        $('.dogo-js-item-content').on('click', '.dogo-js-delete-tpl', function () {
            var row_id = $(this).attr('data-tpl-row');
            layer.msg(row_id);
            layer.confirm('确定要删除吗?', {icon: 3, title:'提示'}, function(index){
                layer.closeAll();
                $('.dogo-js-item-content .dogo-js-item-tpl-' + row_id).remove();
//                setTimeout(function () {
//                    $('.dogo-js-item-content .dogo-js-item-tpl-' + row_id).remove();
//                }, 1000);
            },function (index) {
                layer.closeAll();
            });
        });
        //删除会员id
        $('.dogo-js-item-content').on('click', '.dogo-js-del-approval', function () {
            var user_id = $(this).attr('data-user-id');
            layer.confirm('确定要删除吗?', {icon: 3, title:'提示'}, function(index){
                layer.closeAll();
                $('.dogo-js-item-content .dogo-js-del-user-id-' + user_id).remove();
            },function (index) {
                layer.closeAll();
            });
        });
    });
</script>
