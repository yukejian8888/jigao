<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
{{--{!! Html::style('plugins/element-ui/theme-default/index.css') !!}--}}

<!-- 引入样式 -->
    {!! Html::style('plugins/mint-ui/lib/style.css') !!}
    {!! Html::style('style/weixin/css/dogo.css') !!}
    {!! Html::style('style/weixin/css/wap.css') !!}
    <script src="{{ asset('plugins/vue/vue.js') }}"></script>
    <!-- 引入组件库 -->
    <script src="{{ asset('plugins/mint-ui/index.js') }}"></script>
{!! Html::script('plugins/es6-promise/es6-promise.auto.min.js') !!}
{!! Html::script('plugins/axios/axios.min.js') !!}
{{--{!! Html::script('plugins/adminsir-font/iconfont.js') !!}--}}
{!! Html::script('//at.alicdn.com/t/font_4p2ky4y2hhl7hkt9.js') !!}
{!! Html::script('style/weixin/js/wap.js') !!}
<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="dogo-body">
<div class="dogo-page">

    @yield('content')

</div>

</body>
</html>
