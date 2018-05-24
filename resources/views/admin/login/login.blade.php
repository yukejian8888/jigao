@extends('partials.admin.loginapp')
@section('content')
    @include('partials.common.success')


    <div class="page-container" style="margin-top: 10%;">

        <div class="panel panel-default panel-login">
            <div class="panel-heading">
                <h3 class="panel-title">
                    济南高新控股集团-登录
                </h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => ['passport.login'],'method' => 'post','class'=>'js-ajax-form form-horizontal login-form','role'=>'form','autoComplete'=>'off']) !!}
                    <div class="form-group">
                        <label for="inputName" >
                            账号
                        </label>
                        <div>
                            {!! Form::text('username', '', ['class' => 'form-username form-control','id'=>'form-username','required','autofocus','placeholder'=>'请输入账号']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">
                            密码
                        </label>
                        <div>
                            {!! Form::password('password', ['class' => 'form-password form-control','id'=>'form-password','required','placeholder'=>'请输入密码']) !!}

                        </div>
                    </div>

                    <div class="form-group last">
                        <div class="">
                            <button type="submit" name="submit" class="btn btn-login js-ajax-submit" data-loadingmsg="正在加载...">
                                登陆
                            </button>
                            <button type="reset" class="btn btn-default">
                                取消
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
            <div class="panel-footer" style="padding:10px 0 0 0">
                <small style="color: #750707;font-size: 14px;">
                    * 没有账号请向系统管理员申请
                </small>

            </div>
        </div>

    </div>

    <script type="text/javascript">

        jQuery(function ($) {
            $.supersized({
                // Functionality
                slide_interval: 4000,    // Length between transitions
                transition: 1,    // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                transition_speed: 1000,    // Speed of transition
                performance: 1,    // 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)

                // Size & Position
                min_width: 0,    // Min width allowed (in pixels)
                min_height: 0,    // Min height allowed (in pixels)
                vertical_center: 1,    // Vertically center background
                horizontal_center: 1,    // Horizontally center background
                fit_always: 0,    // Image will never exceed browser width or height (Ignores min. dimensions)
                fit_portrait: 1,    // Portrait images will not exceed browser height
                fit_landscape: 0,    // Landscape images will not exceed browser width

                // Components
                slide_links: 'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                slides: [    // Slideshow Images
                    { image: '../style/admin/images/1P.jpg' },
                    { image: '../style/admin/images/2P.jpg' },
                    { image: '../style/admin/images/3P.jpg' }
                ]
            });
        });
    </script>
@endsection
