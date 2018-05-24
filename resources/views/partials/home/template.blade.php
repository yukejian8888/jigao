<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="baidu_union_verify" content="bf0b2321d66e64b823bd20d88e82f895">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $infos_seo['title']}}</title>
    <meta name="keywords" content="{{ $infos_seo['kwd'] }}" />
    <meta name="description" content="{{ $infos_seo['desc'] }}" />
    <!-- Styles -->
    {!! Html::style('bower_components/AdminLTE/bootstrap/css/bootstrap.min.css') !!}
    {!! Html::style('bower_components/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('plugins/layui/css/layui.css') !!}
    {!! Html::style('http://adminsir.net/style/templet_web/css/slide.css') !!}
    {!! Html::style('http://adminsir.net/style/templet_web/css/common.css') !!}
    {!! Html::style('style/home/css/style.css') !!}

    {!! Html::script('plugins/jquery/jquery-1.12.4.min.js') !!}
    {!! Html::script('plugins/jquery/jquery.SuperSlide.2.1.1.js') !!}

    {!! Html::script('plugins/layui/layui.js') !!}
    {!! Html::script('//at.alicdn.com/t/font_0v4p3w93m0h8semi.js') !!}
    {!! Html::script('bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('style/home/js/common.js') !!}

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div class="dogo-page">
    @include('partials.home.header')
    @yield('content')
    @include('partials.home.footer')
</div>

</body>
</html>
