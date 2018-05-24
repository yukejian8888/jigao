<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Styles -->

    {!! Html::style('style/admin/css/login.css') !!}
    <!-- CSS -->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Javascript -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
{!! html::script('plugins/jquery/jquery-2.2.3.min.js') !!}
{!! html::script('plugins/jquery/supersized.3.2.7.min.js') !!}

{!! Html::script('plugins/AmaranJS/js/jquery.amaran.js') !!}
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app" class="dogo-page-login">
        @yield('content')
    </div>
</body>
</html>
