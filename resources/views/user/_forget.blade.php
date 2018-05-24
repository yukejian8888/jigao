<div class="dogo-login-02 dogo-padding-15">
    <div class="block-bd ">
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    手机号
                </div>
            </div>
            <div class="col-md-8">
                <div class="text-input">
                    <input type="text" class="dogo-input dogo-border-grey" name="phone" placeholder="手机号码" value="13800138000">
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    短信验证码
                </div>
            </div>
            <div class="col-md-5">
                <div class="text-input">
                    <input type="text" class="dogo-input dogo-border-grey" name="sms_code" placeholder="请输入短信验证码">
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-sub-title dogo-btn dogo-btn-red dogo-js-get-sms-code dogo-js-able dogo-js-text" data-attr-able="false">
                    获取验证码
                </div>
            </div>
        </div>
        <!--row-->
        <div class="dogo-blank-20"></div>
        <div class="row line">
            <div class="col-md-3">
                <div class="text-title text-right">
                    密码
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
                    确认密码
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
                    {{--<span><a href="{{route('u.forget')}}">忘记密码</a> </span>--}}
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
        var time = 5;
        $('.dogo-js-get-sms-code').click(function () {
            var phone = $('input[name="phone"]').val();
            var able_attr = $('.dogo-js-able').attr('data-attr-able');
            if(phone==''){
                layer.msg('手机号码不能为空');
                $('input[name="phone"]').get(0).focus();
                return false;
            }
            if(able_attr=='true'){
                layer.msg('请稍后获取验证码');
                return false;
            }
            $.ajax({
                url:"{{route('u.get_forget_sms_code')}}",
                type:'post',
                data:{
                    phone:phone
                },
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend:function () {
                    layer.msg('短信验证码处理中...',{time:60000});
                },
                success:function (response) {
                    var msg = response.msg;
                    layer.closeAll();
                    if(response.status=='s'){
                        //处理数据，禁止再次点击
                        $('.dogo-js-able').removeClass('dogo-btn-red');
                        $('.dogo-js-able').attr('data-attr-able','true');
                        timer();
                        layer.msg(msg);
                    }else if(response.status=='f'){
                        layer.msg(msg);
                    }
                }
            });//ajax
        });
        $('.dogo-js-submit').click(function () {
            var phone = $('input[name="phone"]').val();
            var sms_code = $('input[name="sms_code"]').val();
            var pwd1 = $('input[name="pwd1"]').val();
            var pwd2 = $('input[name="pwd2"]').val();
            if(phone==''){
                layer.msg('手机号码不能为空');
                $('input[name="phone"]').get(0).focus();;
                return false;
            }
            if(sms_code==''){
                layer.msg('短信验证码不能为空');
                $('input[name="sms_code"]').get(0).focus();;
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
            $.ajax({
                url:"{{route('u.check_forget')}}",
                type:'post',
                data:{
                    phone:phone,
                    sms_code:sms_code,
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

        function timer() {
            if (time > 0) {
                time--;
                console.log('this.time:',time);
                $('.dogo-js-text').text(time+"s后重新获取");
                setTimeout(timer, 1000);
            }else if(time==0){
                $('.dogo-js-able').attr('data-attr-able','false');
                $('.dogo-js-able').addClass('dogo-btn-red');
                $('.dogo-js-text').text("获取验证码");
                time = 60;
            }
        }
    });
</script>
@endsection
