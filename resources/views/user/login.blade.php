@php($skin = get_cfg_by_name('cfg_skin'))
@extends('partials.'.$skin.'.template')
@section('content')
    <div class="dogo-page-content dogo-custom-login dogo-wp100">
        <div class="dogo-wp12">
            <div class="dogo-blank-height"></div>
            <div class="row">
                <div class="col-md-3"></div><!--col-md-->
                <div class="col-md-6">
                    <div class="dogo-custom-login-form dogo-border-radius-5 dogo-padding-15">
                        <div class="layui-tab layui-tab-brief">
                            <ul class="layui-tab-title">
                                <li class="layui-this">登录</li>
                                <li><a href="{{route('u.reg')}}">注册</a></li>
                            </ul>
                            <div class="layui-tab-content">
                                <div class="layui-tab-item layui-show">
                                    @include('user._login')
                                </div><!--layui-tab-item-->
                            </div>
                        </div><!--layui-tab-->
                    </div><!--dogo-custom-login-form-->
                </div><!--col-md-->
                <div class="col-md-3"></div><!--col-md-->
            </div><!--row-->


        </div><!--wp12-->
    </div><!--dogo-page-content-->





    <script>
        //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
        layui.use('element', function () {
            var element = layui.element();
        });
        $(function () {
            var page_height = $(window).height();
            $('.dogo-page-content').css({'height':page_height});
            $('.dogo-blank-height').css({'height':100});
        });
    </script>
@endsection

