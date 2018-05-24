<div class="panel panel-default">
    <div class="panel-heading">
        @include('partials.admin._boxhead',['box_title'=>$box_title,'backurl'=>$backurl,'param'=>[]])
    </div>
    <!--panel-heading-->
    <div class="panel-body">

        <input type="hidden" name="id" value="{{$infos['id']}}"/>
        <div class="form-group yu-js-content" style="width: 800px;margin: 0 auto;">
            {!! $infos_form !!}
            <span class="help-block m-b-none">
                </span>
        </div>

    </div>
    <!--/--panel-body-->
    {{--<div class="panel-footer">--}}
        {{--<a href="{{route($backurl,$param)}}" class="btn btn-default">取消&返回</a>--}}
    {{--</div>--}}
</div>


<script type="text/javascript">
    $(function () {
        var content_str = '{!! $infos["content"] !!}';  //获取表单中填写的数据
        var content_obj = $.parseJSON(content_str);    //解析json字符串为json对象

        //给text文本框赋值显示到页面
        $("input[type=text]").each(function () {
            var name = $(this).attr("name");
            var input_data = content_obj[name];
            if (input_data) {
                //console.log('input_data',input_data);
                $('input[name="' + name + '"]').val(input_data);
            }
        });
        //给多行文本赋值显示到页面
        $("textarea").each(function () {
            var name = $(this).attr("name");
            var textarea_data = content_obj[name];
            $('textarea[name="' + name + '"]').val(textarea_data);
        });

        //给下拉列表赋值显示到页面
        $("select").each(function () {
            var name = $(this).attr("name");
            var select_data = content_obj[name];
            $('select[name="' + name + '"]').val(select_data);
        });

        //复选框赋值显示到页面
        $(".yu-js-content input[type=checkbox]").each(function () {
            var name = $(this).attr("name");
            var checkbox_data = content_obj[name];
            if ($(this).val() == checkbox_data) {
                $(this).attr("checked", "true");
            }
        });

        //单选框赋值显示到页面
        $('.yu-js-content input[type=radio]').each(function () {
            //alert($(this).attr("name"));
            var name = $(this).attr("name");
            var radio_data = content_obj[name];
            //console.log(radio_data);
            if ($(this).val() == radio_data) {
                $(this).attr("checked", "true");
            }
        });
    })
</script>

