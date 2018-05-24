@extends('partials.weixin.template_mintui')
@section('content')
    <div class="dogo-mintui-app">
        <mt-header title="个人资料修改" fixed>
            <mt-button icon="back" slot="left" @click.native="handleBack"></mt-button>
        </mt-header>

        <div class="dogo-page-box dogo-form-change">
            <div class="dogo-page-box-header logo text-center">
                <div >
                    <img id="avatar" :src="form.avatar"/>
                </div>
                <div class="upload-btn">
                    <input type="file" @click="upload" name="file" lay-type="images" lay-title="更改头像" class="layui-upload-file dogo-layui-upfile">
                </div>

            </div>
            <div class="dogo-page-box-body">
                {{--<mt-field label="生日" placeholder="请输入生日" type="date"></mt-field>--}}
                <mt-field label="自我介绍" placeholder="自我介绍" v-model="form.signature" type="textarea" rows="4"></mt-field>
                <mt-radio
                        title="性别"
                        v-model="form.sex"
                        :options="form.options">
                </mt-radio>
                <div class="dogo-submit-section dogo-padding-10">
                    <button class="mint-button dogo-btn-sub mint-button--large" @click="onSubmit">
                        <label class="mint-button-text">提交</label>
                    </button>
                </div>
            </div>
            <div class="dogo-page-box-footer">

            </div>
        </div>


    </div>
    <script>
        layui.use(['upload','layer'], function(){
            var upload = layui.upload;
            var layer = layui.layer;
            upload();
        });

        new Vue({
            el: '.dogo-mintui-app',
            data: {
                form:{
                    signature:'{{$infos["signature"]}}',
                    avatar:'{{$infos["avatar"]}}',
                    sex:'{{$infos["sex"]}}',
                    options:[
                        {
                            label: '男',
                            value: '10',
                        },
                        {
                            label: '女',
                            value: '11'
                        },
                        {
                            label: '保密',
                            value: '12'
                        }
                    ]
                },
                selected: 1
            },
            methods: {
                handleBack:function () {
                    window.location.href=history.go(-1);
                },
                onSubmit: function () {
                    var self = this;
                    var signature = self.form.signature;
                    var avatar = self.form.avatar;
                    var sex = self.form.sex;
                    var url = "{{route('u_weixin_info.update')}}";
                    axios.post(url,{
                        avatar:avatar,
                        signature:signature,
                        sex:sex
                    }).then(function (response) {
                        if(response.data.status=='s'){
                            self.$toast({
                                message: response.data.msg,
                                iconClass: 'icon icon-success'
                            });
                            setTimeout(window.location.href = response.data.url, 3000);
                        }else if(response.data.status=='f'){
                            self.$toast({
                                message: response.data.msg,
                                iconClass: 'icon icon-warning'
                            });
                        }
                    });
                },
                upload:function () {
                    var self = this;
                    var upload = layui.upload;
                    var layer = layui.layer;
                    upload({
                        elem:'.layui-upload-file',
                        url: '{{route("upload")}}',
                        ext: 'jpg|png|gif',
                        method:'post',
                        before: function(input){
                            //返回的参数item，即为当前的input DOM对象
//                console.log('文件上传中');
                            layer.msg('文件上传中', {
                                icon: 16
                                ,shade: 0.01
                                ,time: 60*1000 //60s后自动消失
                            });
                        },
                        success: function(res){
                            layer.closeAll();
                            console.log(res); //上传成功返回值，必须为json格式
                            if(res.status=='s'){
                                //上传成功
//                                document.getElementById('avatar').src = res.data.filepath;
                                self.form.avatar = res.data.filepath;
                            }else {
                                layer.msg(res.msg);
                            }
                        }
                    });
                }
            }

        })

    </script>
@endsection
