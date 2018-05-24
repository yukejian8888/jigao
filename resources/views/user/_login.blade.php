<div class="dogo-login-02 dogo-padding-15">
    <div class="block-bd ">
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    账户密码
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="text" class="dogo-input dogo-border-grey" name="name" placeholder="用户名/手机号/邮箱">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    账户
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="password" class="dogo-input dogo-border-grey" name="password" placeholder="密码">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-12 text-center">
                <div class="text-sub-title dogo-btn dogo-btn-red dogo-js-submit">
                    登录
                </div>
            </div>
        </div>
        <!--row-->
        <div class="row line">
            <div class="col-md-12 text-center">
                <div class="text-sub-title ">
                    <span><a href="{{route('u.forget')}}">忘记密码</a> </span>
                </div>
            </div>
        </div>
        <!--row-->
    </div>
    <!--block-bd-->
</div>
<!--login-->
<script>
    layui.use(['layer'], function(){
        var layer = layui.layer;
    });
    $(function () {
        $('.dogo-js-submit').click(function () {
            var name = $('input[name="name"]').val();
            var password = $('input[name="password"]').val();
            if(name==''){
                layer.msg('账号不能为空');
                $('input[name="name"]').get(0).focus();;
                return false;
            }
            if(password==''){
                layer.msg('密码不能为空');
                $('input[name="password"]').get(0).focus();;
                return false;
            }
            $.ajax({
                url:"{{route('u.check_login')}}",
                type:'post',
                data:{
                    username:name,
                    password:password
                },
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend:function () {
                    layer.msg('账号校验中',{time:60000});
                },
                success:function (response) {
                    var msg = response.msg;
                    layer.closeAll();
                    if(response.status=='s'){
                        layer.msg(msg);
                        window.location.href = response.url;
                    }else {
                        layer.msg(msg);
                    }
//                    setTimeout(layer.closeAll(),3000);
                }
            });//ajax
        });
    });
</script>