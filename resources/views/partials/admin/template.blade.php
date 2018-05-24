<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>工程管理系统</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- FONT AWESOME-->
{!! Html::style('vendor/fontawesome/css/font-awesome.min.css') !!}
<!-- SIMPLE LINE ICONS-->
{!! Html::style('vendor/simple-line-icons/css/simple-line-icons.css') !!}
<!-- ANIMATE.CSS-->
{!! Html::style('vendor/animate.css/animate.min.css') !!}
<!-- WHIRL (spinners)-->
{!! Html::style('vendor/whirl/dist/whirl.css') !!}
<!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- WEATHER ICONS-->
{!! Html::style('vendor/weather-icons/css/weather-icons.min.css') !!}
<!-- =============== BOOTSTRAP STYLES ===============-->
{!! Html::style('vendor/angle/css/bootstrap.css',['id'=>'bscss']) !!}
<!-- =============== APP STYLES ===============-->
{!! Html::style('vendor/angle/css/app.css',['id'=>'maincss']) !!}
    {!! Html::style('plugins/layui/css/layui.css') !!}
    {!! Html::script('plugins/layui/layui.js') !!}
{!! Html::style('style/admin/css/style.css') !!}


<!-- MODERNIZR-->
{!! Html::script('vendor/modernizr/modernizr.custom.js') !!}
<!-- MATCHMEDIA POLYFILL-->
{!! Html::script('vendor/matchMedia/matchMedia.js') !!}
<!-- JQUERY-->
{!! Html::script('plugins/jquery/jquery-2.2.3.min.js') !!}
<!-- BOOTSTRAP-->
{!! Html::script('vendor/bootstrap/dist/js/bootstrap.js') !!}
<!-- STORAGE API-->
{!! Html::script('vendor/jQuery-Storage-API/jquery.storageapi.js') !!}
<!-- JQUERY EASING-->
{!! Html::script('vendor/jquery.easing/js/jquery.easing.js') !!}
<!-- ANIMO-->
{!! Html::script('vendor/animo.js/animo.js') !!}
<!-- SLIMSCROLL-->
{!! Html::script('vendor/slimScroll/jquery.slimscroll.min.js') !!}
<!-- SCREENFULL-->
{!! Html::script('vendor/screenfull/dist/screenfull.js') !!}
<!-- LOCALIZE-->
<!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- SPARKLINE-->
{!! Html::script('vendor/sparkline/index.js') !!}
<!-- FLOT CHART-->
{!! Html::script('vendor/Flot/jquery.flot.js') !!}
{!! Html::script('vendor/flot.tooltip/js/jquery.flot.tooltip.min.js') !!}
{!! Html::script('vendor/Flot/jquery.flot.resize.js') !!}
{!! Html::script('vendor/Flot/jquery.flot.pie.js') !!}
{!! Html::script('vendor/Flot/jquery.flot.time.js') !!}
{!! Html::script('vendor/Flot/jquery.flot.categories.js') !!}
{!! Html::script('vendor/flot-spline/js/jquery.flot.spline.min.js') !!}
<!-- CLASSY LOADER-->
{!! Html::script('vendor/jquery-classyloader/js/jquery.classyloader.min.js') !!}
<!-- MOMENT JS-->
{!! Html::script('vendor/moment/min/moment-with-locales.min.js') !!}
<!-- =============== APP SCRIPTS ===============-->
    {!! Html::script('vendor/angle/js/app.js') !!}
    {!! Html::script('style/admin/js/common.js') !!}
</head>

<body>
<div class="wrapper">
{{--@php($user_info = get_user_info(Session::get('user_id')))--}}
<!-- Main Header -->
@include('partials.admin._header')

<!-- Left side column. contains the logo and sidebar -->
@include('partials.admin._sidebar_left')

<!-- Content Wrapper. Contains page content -->
    <!-- Main section-->
    <section>
        <!-- Page content-->
        <div class="content-wrapper">
        @yield('content')
        </div>
    </section>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
@include('partials.admin._footer')

<!-- Control Sidebar -->
    @include('partials.admin._sidebar_right')
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
@yield('content_second')
</body>
</html>
