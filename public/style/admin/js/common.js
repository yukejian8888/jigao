/**
 * Created by cooper on 2016/12/7.
 */
layui.use('layer', function(){
    var layer = layui.layer;
});
$(function () {
    $('.dogo-click-delete').click(function () {
        var title = $(this).attr('data-title');
        var url = $(this).attr('data-url');
        var row_id = $(this).attr('data-id');
        layer.confirm('确定要删除【'+title+'】吗?', {icon: 3, title:'提示'}, function(index){
            getfetch(url,row_id);
            // layer.msg('操作成功！');
            layer.close(index);
        },function (index) {
            layer.close(index);
        });
    });
});
function dogoDeleteTreegrid(url,title) {
    // alert(url+name);
    layer.confirm('确定要删除【'+title+'】吗?', {icon: 3, title:'提示'}, function(index){
        getfetch_treegrid(url);
        // layer.msg('操作成功！');
        layer.close(index);
    },function (index) {
        layer.close(index);
    });
    $('#dogo_treegrid').treegrid('reload');
}
function getfetch(url,row_id) {
    $.ajax({
        url:url,
        type:'DELETE',
        data:{},
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function (response) {
            var msg = response.msg;
            if(response.status=='s'){
                //remove tr
                $('.dogo-remove-'+row_id).remove();
            }
            $.notify({
                'message'   :msg,
                'status'  :'info',
                'timeout'  :'2200',
            });
        }

    });
}
function getfetch_treegrid(url) {
    $.ajax({
        url:url,
        type:'DELETE',
        data:{},
        dataType:'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success:function (response) {
            var msg = response.msg;
            if(response.status=='s'){
                //remove tr
                $('#dogo_treegrid').treegrid('reload');
            }
            $.notify({
                'message'   :msg,
                'status'  :'info',
                'timeout'  :'2200',
            });
        }

    });
}
