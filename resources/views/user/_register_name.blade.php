<div class="dogo-login-02 dogo-padding-15">
    <div class="block-bd ">
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    用户名<span class="color-red">*</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="text" class="dogo-input dogo-border-grey" name="name" placeholder="用户名" value="">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    密码<span class="color-red">*</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="password" class="dogo-input dogo-border-grey" name="pwd1" placeholder="请输入密码">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    确认密码<span class="color-red">*</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="password" class="dogo-input dogo-border-grey" name="pwd2" placeholder="请再次输入密码">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    邮箱<span class="color-red">*</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="text" class="dogo-input dogo-border-grey" name="email" placeholder="请输入邮箱">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-12 text-center">
                <div class="text-sub-title dogo-btn dogo-btn-red dogo-js-submit">
                    提交
                </div>
            </div>
        </div>
        <!--row-->
        <div class="row line">
            <div class="col-md-12 text-center">
                <div class="text-sub-title ">
{{--                    <span><a href="{{route('u.forget')}}">忘记密码</a> </span>--}}
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
            var email = $('input[name="email"]').val();
            var pwd1 = $('input[name="pwd1"]').val();
            var pwd2 = $('input[name="pwd2"]').val();
            if(name==''){
                layer.msg('用户名不能为空');
                $('input[name="name"]').get(0).focus();;
                return false;
            }
            if(pwd1==''){
                layer.msg('密码不能为空');
                $('input[name="pwd1"]').get(0).focus();;
                return false;
            }
            if(pwd2==''){
                layer.msg('确认密码不能为空');
                $('input[name="pwd2"]').get(0).focus();;
                return false;
            }

            if(email==''){
                layer.msg('邮箱不能为空');
                $('input[name="email"]').get(0).focus();;
                return false;
            }
            $.ajax({
                url:"{{route('u.check_reg_name')}}",
                type:'post',
                data:{
                    name:name,
                    email:email,
                    password:pwd1,
                    pwd2:pwd2,
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
                        setTimeout(window.location.href = response.url,3000);
                    }else {
                        layer.msg(msg);
                    }
                }
            });//ajax
        });
    });
</script>