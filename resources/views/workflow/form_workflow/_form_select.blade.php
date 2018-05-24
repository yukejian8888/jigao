{!! Html::script('plugins/art-template/template-web.js') !!}
<!-- Modal-->
<div id="modal_approval" tabindex="-1" role="dialog" aria-labelledby="myModalLabelLarge" aria-hidden="true"
     class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 id="myModalLabelLarge" class="modal-title">选择审批人员</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        @php($infos_user = get_user_list_all())
                        <table id="table-ext-1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th data-check-all=""></th>
                                <th style="width: 30px;">UID</th>
                                <th style="width: 80px;">用户名</th>
                                <th style="width: 90px;">手机号</th>
                                {{--<th style="width: 50px;">性别</th>--}}
                                {{--<th style="width: 50px;">部门</th>--}}
                                {{--<th style="width: 150px;">单位</th>--}}
                                {{--<th style="width: 80px;">职务</th>--}}
                            </tr>
                            </thead>
                            <tbody id="view"></tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                <button type="button" class="btn btn-primary dogo-js-select-submit" data-row-id="">确定</button>
            </div>
        </div>
    </div>
</div>
<script id="tpl-approval" type="text/html">

    @{{ each list value i }}
    <tr>
        <td>
            <div class="checkbox c-checkbox">
                <label>
                    <input type="checkbox" name="checkbox_user" value="@{{ value.id }}">
                    <span class="fa fa-check"></span>
                </label>
            </div>
        </td>
        <td>@{{ value.id }}</td>
        <td>@{{ value.name }}</td>
        <td>@{{ value.phone }}</td>
    </tr>
    @{{/each}}
</script>
<script>

    $(function () {
        //添加审批人员
        $('.dogo-js-item-content').on('click', '.dogo-js-add-approval', function () {
            var row_id = $(this).attr('data-tpl-row');
            $('#modal_approval').modal('show');
            $('.dogo-js-select-submit').attr('data-row-id',row_id);
            var url = '{{route("admin.form_workflow.get_approval")}}'+'?time='+Math.random();
            //获取已选择的用户id
            var user_id = new Array();
            $('input[name="user_id['+row_id+'][]"]').each(function () {
                user_id.push($(this).val());
            });

            $.ajax({
                url:url,
                type:'post',
                data:{
                    user_id:user_id.join(',')
                },
                dataType:'json',
                beforeSend:function () {
                    layer.load(2);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (response) {
                    layer.closeAll('loading');
                    var html = template('tpl-approval', response);
                    document.getElementById('view').innerHTML = html;
                }
            });
        });
        $('.dogo-js-select-submit').click(function () {
            var row_id = $(this).attr('data-row-id');
            $('input[name="checkbox_user"]:checked').each(function () {
                var checked_val = $(this).val();
                //增加会员名称，异步获取用户信息
                var url = '{{route("admin.form_workflow.get_user")}}';
                $.ajax({
                    url:url,
                    type:'post',
                    data:{
                        user_id:checked_val
                    },
                    dataType:'json',
                    beforeSend:function () {
                        layer.load(2);
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function (response) {
                        layer.closeAll('loading');
                        console.log(response);
                        if(response.status=='s'){
                            var html_user = '<span class="dogo-warp-approval dogo-js-del-user-id-'+response.data.id+'">'+
                                '<input type="hidden" name="user_id['+row_id+'][]" value="'+checked_val+'"/>'+
                                '<span class="dogo-border">'+response.data.name+'</span>'+
                                '<i class="fa icon-close dogo-font-close dogo-js-del-approval" data-user-id="'+response.data.id+'"></i>'+
                                '</span>';
                            $('.dogo-flow-row-id-'+row_id).append(html_user);
                        }
                    }
                });
            });
            $('#modal_approval').modal('hide');
        });

    })
</script>