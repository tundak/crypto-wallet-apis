<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('AssetsAdmin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AssetsAdmin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AssetsAdmin/bower_components/Ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AssetsAdmin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AssetsAdmin/plugins/iCheck/square/blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admincustome.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--<- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link href="{{ 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic' }}" rel="stylesheet">
</head>
<body class="hold-transition register-page" >
    
    {{-- Body --}}
    @yield('content')
    
    <!-- Scripts -->
    <script src="{{ asset('AssetsAdmin/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('AssetsAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('AssetsAdmin/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
</body>
</html>
