<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>秋允电子商务内容管理系统</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <!-- Ionicons -->
{{--<link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/ionicons.min.css")}}">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/dist/css/skins/skin-red-light.min.css")}}">
    <link rel="stylesheet" href="{{asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}">
{!! Html::style('plugins/AmaranJS/css/amaran.min.css') !!}
{!! Html::style('plugins/easyui/themes/bootstrap/easyui.css') !!}
{!! Html::style('style/admin/css/style.css') !!}
<!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('/bower_components/AdminLTE/plugins/iCheck/all.css')}}">
    <!-- iCheck 1.0.1 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.2.3 -->
{!! Html::script('plugins/jquery/jquery-2.2.3.min.js') !!}
{!! Html::style('plugins/layui/css/layui.css') !!}
{!! Html::script('plugins/layui/layui.js') !!}
<!-- Bootstrap 3.3.6 -->
    <script src="{{asset("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>
    {!! Html::script('plugins/AmaranJS/js/jquery.amaran.js') !!}
    <script src="{{asset('/bower_components/AdminLTE/plugins/iCheck/icheck.min.js')}}"></script>
    {!! Html::script('plugins/easyui/jquery.easyui.min.js') !!}
    {!! Html::script('style/admin/js/common.js') !!}
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="dogo-app-body hold-transition skin-blue sidebar-mini">
<div class="wrapper">
@php($user_info = get_user_info(Session::get('user_id')))

<!-- Main Header -->
@include('partials.user.header')

<!-- Left side column. contains the logo and sidebar -->
@include('partials.user.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @yield('content')



    <!-- Your Page Content Here -->


    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
@include('partials.user.footer')


<!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>
